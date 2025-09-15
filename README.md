📄 Online Reprographic System

The Online Reprographic System is a web-based application that allows students and users to upload documents (PDFs, images), 
configure print settings, and make payments online for reprographic (printing and photocopying) services.

✨ Features

•	Document Upload: Upload files in PDF, JPG, or PNG formats.

•	Print Options: Choose paper size (A4, A3), print sides (single/double), and color preferences (B&W or color).

•	Dynamic Price Calculation: Price is calculated automatically based on number of pages, copies, layout, and print options.

•	Payment Gateway Integration: Integrated with Razorpay for secure and seamless online payments.

•	Token Generation: After successful payment, the system generates a unique token for tracking print orders.

•	Email Notifications: Uses PHPMailer to send order details and attachments via email.

•	Responsive Design: Optimized for both desktop and mobile users.

🛠️ Tech Stack

•	Frontend: HTML, CSS, Bootstrap, JavaScript (with jQuery)

•	Backend: PHP

•	Email Service: PHPMailer (SMTP with Gmail)

•	Payment Integration: Razorpay API

•	File Handling: pdf.js for page counting in PDF documents

🚀 Workflow

1.	User fills out the form with personal details, print settings, and uploads the document.
   
2.	The system counts pages (using pdf.js for PDFs) and calculates the total cost dynamically.
   
3.	User proceeds to pay through Razorpay.
   
4.	Upon successful payment, a unique token is generated and displayed.
   
5.	Order details, along with the uploaded document, are sent to the reprographic service via email.
    
6.	The reprographic center processes the order using the provided token.

📌 Use Cases

•	University/College reprographic centers

•	Print shops offering online document submission

•	Office/enterprise printing services

