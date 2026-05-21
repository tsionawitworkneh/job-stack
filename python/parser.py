import sys
import PyPDF2
import mysql.connector
import re


db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="job_stack"
)
cursor = db.cursor(dictionary=True)

def extract_skills_from_pdf(file_path):
    
    skill_bank = ['php', 'javascript', 'html', 'css', 'react', 'python', 'mysql', 'node.js', 'ui/ux', 'java', 'sql', 'design']
    text = ""
    try:
        with open(file_path, 'rb') as f:
            reader = PyPDF2.PdfReader(f)
            for page in reader.pages:
                text += page.extract_text()
        text = text.lower()
        
        found = [skill for skill in skill_bank if skill in text]
        return found
    except:
        return []

def run_analysis(user_id, file_path):
    user_skills = extract_skills_from_pdf(file_path)
    if not user_skills:
        return

    
    cursor.execute("DELETE FROM ai_insights WHERE user_id = %s", (user_id,))
    
    
    cursor.execute("SELECT id, title, description, requirements FROM jobs")
    jobs = cursor.fetchall()

    for job in jobs:
        
        job_content = (job['title'] + " " + job['description'] + " " + (job['requirements'] or "")).lower()
        
        matches = [s for skill in user_skills if (s := skill) in job_content]
        
        
        score = int((len(matches) / len(user_skills)) * 100) if user_skills else 0
        
        
        missing = [s for s in ['php', 'react', 'python', 'sql'] if s in job_content and s not in user_skills]

        
        sql = """INSERT INTO ai_insights (user_id, job_id, strengths, missing_skills, recommendations, match_score) 
                 VALUES (%s, %s, %s, %s, %s, %s)"""
        val = (user_id, job['id'], ", ".join(user_skills), ", ".join(missing), 
               f"You have a strong match for {job['title']}!", score)
        cursor.execute(sql, val)

    db.commit()

if __name__ == "__main__":
    
    if len(sys.argv) > 2:
        run_analysis(sys.argv[1], sys.argv[2])