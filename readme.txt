send email campaigns to sendgrid and save there

https://api.sendgrid.com/api/newsletter/add.json
identity=Sender_Address&name=SendGrid_Test&subject=testsubject&text=testtextbody&html=%3Chtml%3E%3Cp%3Etest_html_body%3C%2Fp%3E%3C%2Fhtml%3E&api_user=your_sendgrid_username&api_key=your_sendgrid_password


add email to list
Call
POST	https://api.sendgrid.com/api/newsletter/lists/email/add.json
POST Data	list=Test&data=%7B%22email%22%3A%22example%40gmail.com%22%2C%22name%22%3A%22example%22%7D&api_user=your_sendgrid_username&api_key=your_sendgrid_password


upload the email campaigns with days
upload the list
schedule 


set from email in sendgrid

//create webform to let them add emails to DB from their website

//use amazon SES in future


