@extends('Frontend.layout.main')
@section('main-section')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .logo-icon {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #7f8c8d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .content-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 992px) {
            .content-area {
                grid-template-columns: 1fr;
            }
        }
        
        .card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f1f1;
        }
        
        .card-title i {
            color: #3498db;
        }
        
        h2 {
            font-size: 1.8rem;
        }
        
        .info-box {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .info-box h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-box p {
            color: #555;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        input:focus, textarea:focus, select:focus {
            border-color: #3498db;
            outline: none;
        }
        
        textarea {
            min-height: 150px;
            resize: vertical;
            font-family: inherit;
        }
        
        .phone-example {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            border: none;
            padding: 16px 30px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn:hover {
            background: linear-gradient(135deg, #2980b9, #1c2833);
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn i {
            margin-right: 10px;
        }
        
        .message-preview {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            border-left: 5px solid #3498db;
        }
        
        .message-preview h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .message-preview p {
            color: #555;
            white-space: pre-line;
        }
        
        .supplier-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        
        .supplier-item {
            background-color: #eef5ff;
            border-radius: 50px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .supplier-item:hover {
            background-color: #dfeafc;
        }
        
        .supplier-item.active {
            background-color: #3498db;
            color: white;
        }
        
        .supplier-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #2c3e50;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        footer {
            text-align: center;
            padding: 25px;
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 40px;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #2ecc71;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateX(150%);
            transition: transform 0.5s ease;
            z-index: 1000;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .char-count {
            text-align: right;
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        .char-count.warning {
            color: #e74c3c;
        }
    </style>

    <div class="container">
        <header>
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h1>Fast Approval Request</h1>
            </div>
            <p class="subtitle">Send urgent approval requests to your suppliers with just a few clicks. Include phone numbers and custom messages for faster response times.</p>
        </header>
        
        <main class="content-area">
            <section class="card">
                <div class="card-title">
                    <i class="fas fa-edit"></i>
                    <h2>Create Request</h2>
                </div>
                
                <div class="info-box">
                    <h3><i class="fas fa-info-circle"></i> How it works</h3>
                    <p>Fill in the supplier details and your message below. The system will send an urgent approval request with your phone number for immediate contact.</p>
                </div>
                
                <form id="approvalForm">
                    <div class="form-group">
                        <label for="supplier">Select Supplier</label>
                        <div class="supplier-list">
                            <div class="supplier-item active" data-id="1">
                                <div class="supplier-avatar">AJ</div>
                                <div class="supplier-info">
                                    <strong>Alpha Suppliers</strong>
                                    <div>Electronics</div>
                                </div>
                            </div>
                            <div class="supplier-item" data-id="2">
                                <div class="supplier-avatar">BG</div>
                                <div class="supplier-info">
                                    <strong>Beta Goods</strong>
                                    <div>Raw Materials</div>
                                </div>
                            </div>
                            <div class="supplier-item" data-id="3">
                                <div class="supplier-avatar">CS</div>
                                <div class="supplier-info">
                                    <strong>Gamma Supplies</strong>
                                    <div>Packaging</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Your Contact Number</label>
                        <div class="input-with-icon">
                            <i class="fas fa-phone"></i>
                            <input type="text" id="phone" placeholder="Enter your phone number" value="+1 (555) 123-4567">
                        </div>
                        <div class="phone-example">Example: +1 (555) 123-4567 or +44 20 7946 0958</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="urgency">Urgency Level</label>
                        <div class="input-with-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                            <select id="urgency">
                                <option value="high">High Priority - Immediate response needed</option>
                                <option value="medium" selected>Medium Priority - Response within 24 hours</option>
                                <option value="low">Low Priority - Response when convenient</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message to Supplier</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <textarea id="message" placeholder="Enter your message for fast approval...">Dear Supplier,

We need urgent approval for the upcoming shipment of components. Please review and approve by tomorrow.

The order details:
- Product: XT-200 Components
- Quantity: 500 units
- Delivery date: 15th of next month

Please contact me at the provided number if you have any questions.

Thank you,
Procurement Team</textarea>
                        </div>
                        <div class="char-count" id="charCount">0/1000 characters</div>
                    </div>
                    
                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i> Send Approval Request
                    </button>
                </form>
            </section>
            
            <section class="card">
                <div class="card-title">
                    <i class="fas fa-eye"></i>
                    <h2>Request Preview</h2>
                </div>
                
                <div class="info-box">
                    <h3><i class="fas fa-bell"></i> What the supplier will receive</h3>
                    <p>This is how your request will appear to the supplier. It includes your contact information and message formatted for clarity.</p>
                </div>
                
                <div class="message-preview">
                    <h4>URGENT: Approval Request Needed</h4>
                    <p><strong>From:</strong> Procurement Department</p>
                    <p><strong>Contact:</strong> <span id="previewPhone">+1 (555) 123-4567</span></p>
                    <p><strong>Urgency:</strong> <span id="previewUrgency">Medium Priority - Response within 24 hours</span></p>
                    <p><strong>Message:</strong></p>
                    <p id="previewMessage">Dear Supplier,

We need urgent approval for the upcoming shipment of components. Please review and approve by tomorrow.

The order details:
- Product: XT-200 Components
- Quantity: 500 units
- Delivery date: 15th of next month

Please contact me at the provided number if you have any questions.

Thank you,
Procurement Team</p>
                </div>
                
                <div class="info-box" style="margin-top: 30px;">
                    <h3><i class="fas fa-clock"></i> Expected Response Times</h3>
                    <p><strong>High Priority:</strong> Within 2 hours (phone call expected)</p>
                    <p><strong>Medium Priority:</strong> Within 24 hours (email or phone)</p>
                    <p><strong>Low Priority:</strong> Within 3 business days (email)</p>
                </div>
            </section>
        </main>
        
        <footer>
            <p>© 2023 Supplier Fast Approval System. All rights reserved.</p>
            <p>This portal is designed for urgent supplier communications.</p>
        </footer>
        
        <div class="notification" id="notification">
            <i class="fas fa-check-circle"></i> Approval request sent successfully!
        </div>
    </div>

    <script>
        // DOM Elements
        const approvalForm = document.getElementById('approvalForm');
        const phoneInput = document.getElementById('phone');
        const messageInput = document.getElementById('message');
        const urgencySelect = document.getElementById('urgency');
        const charCount = document.getElementById('charCount');
        const notification = document.getElementById('notification');
        const supplierItems = document.querySelectorAll('.supplier-item');
        
        // Preview elements
        const previewPhone = document.getElementById('previewPhone');
        const previewMessage = document.getElementById('previewMessage');
        const previewUrgency = document.getElementById('previewUrgency');
        
        // Character counter for message
        messageInput.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/1000 characters`;
            
            if (length > 900) {
                charCount.classList.add('warning');
            } else {
                charCount.classList.remove('warning');
            }
            
            // Update preview
            previewMessage.textContent = this.value;
        });
        
        // Update phone preview
        phoneInput.addEventListener('input', function() {
            previewPhone.textContent = this.value || '[No phone provided]';
        });
        
        // Update urgency preview
        urgencySelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            previewUrgency.textContent = selectedOption.text;
        });
        
        // Supplier selection
        supplierItems.forEach(item => {
            item.addEventListener('click', function() {
                supplierItems.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Initialize character count on load
        charCount.textContent = `${messageInput.value.length}/1000 characters`;
        
        // Form submission
        approvalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const phone = phoneInput.value.trim();
            const message = messageInput.value.trim();
            const urgency = urgencySelect.value;
            const selectedSupplier = document.querySelector('.supplier-item.active');
            const supplierName = selectedSupplier.querySelector('.supplier-info strong').textContent;
            
            // Validation
            if (!phone) {
                alert('Please enter your phone number');
                phoneInput.focus();
                return;
            }
            
            if (!message) {
                alert('Please enter a message for the supplier');
                messageInput.focus();
                return;
            }
            
            // Show notification
            notification.classList.add('show');
            
            // In a real application, you would send the data to a server here
            console.log('Sending approval request:');
            console.log('Supplier:', supplierName);
            console.log('Phone:', phone);
            console.log('Urgency:', urgency);
            console.log('Message:', message);
            
            // Reset notification after 3 seconds
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
            
            // In a real app, you might reset the form here
            // approvalForm.reset();
        });
        
        // Add some interactivity to the form
        document.querySelectorAll('input, textarea, select').forEach(element => {
            // Add focus effect
            element.addEventListener('focus', function() {
                this.parentElement.style.borderColor = '#3498db';
            });
            
            element.addEventListener('blur', function() {
                this.parentElement.style.borderColor = '#e1e8ed';
            });
        });
        
        // Simulate a successful send on page load for demo purposes
        window.addEventListener('load', function() {
            setTimeout(() => {
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 2000);
            }, 1000);
        });
    </script>

@endsection