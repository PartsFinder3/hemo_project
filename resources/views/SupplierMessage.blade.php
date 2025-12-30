<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parts Finder UAE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon"  href="https://partsfinder.ae/storage/logo/44444.png">
   <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>
<style>
    *{
        margin: 0px;
        padding: 0px;
    }
    body, h1, h2, h3, h4, h5, h6, p, div, a, button, small {
    font-family: 'Montserrat', sans-serif;
}
.approval-banner{
    
    max-width:950px;
    margin:40px auto;
    margin-top: 10px !important;
    background:#fff;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
    overflow:hidden;
}
.banner-header{
    padding:30px;
    background:linear-gradient(135deg,#ff7700,#ff9900);
    color:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:20px;
}
.banner-title{
    display:flex;
    gap:20px;
    align-items:center;
}
.logo-img{
    height:126px;
    border-radius:10px;
    position: absolute;
}

.title-text h1{
    font-size:1.7rem;
    font-weight:700;
    margin-left: 160px;
}
.banner-subtitle{
    opacity:.9;
}
.urgency-badge{
    background:#ff3b30;
    padding:12px 24px;
    border-radius:50px;
    font-weight:700;
    animation:pulse 2s infinite;
}
.banner-content{
    padding:30px;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
}
.message-section,.contact-section{
    background:#f8f9fa;
    padding:25px;
    border-radius:15px;
}
.section-title{
    display:flex;
    gap:10px;
    align-items:center;
    color:black;
    font-size:1.4rem;
    margin-bottom:20px;
}
.message-text{
    font-size:1.1rem;
    line-height:1.7;
    color:#444;
}
.supplier-info{
    margin-top:20px;
    background:#fff;
    padding:15px;
    border-radius:12px;
    display:flex;
    gap:15px;
    align-items:center;
}
.supplier-avatar{
    width:55px;
    height:55px;
    background:#ff7700;
    color:#fff;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:bold;
}
.contact-item{
    display:flex;
    gap:15px;
    margin-bottom:15px;
}
.contact-icon{
    width:48px;
    height:48px;
    background:#ff7700;
    color:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}
.banner-footer{
    padding:25px 30px;
    background:#f1f1f1;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:20px;
}
.btn{
    padding:14px 28px;
    border-radius:12px;
    font-weight:600;
    border:none;
    cursor:pointer;
    transition:.3s;
}
.btn-primary{
    background:#198754;
    color:#fff;
}
.btn-primary:hover{
    background:#198754;
}
.btn-secondary{
    background:#fff;
    border:2px solid #ff7700;
    color:#ff7700;
}
.btn-secondary:hover{
    background:#ff7700;
    color:#fff;
}
.response-time{
    font-weight:600;
    color:#ff7700;
    padding: 12px;
}
@keyframes pulse{
    0%{box-shadow:0 0 0 0 rgba(255,59,48,.6)}
    70%{box-shadow:0 0 0 12px rgba(255,59,48,0)}
}
@media(max-width:768px){
    .banner-content{grid-template-columns:1fr}
}
.section-title h2 {
    color: black !important; /* Set section titles to black */
}
.sect {
    display: flex;
    align-items: center; /* vertically center the icon and text */
    gap: 10px;           /* space between icon and text */
}
.fa-headset:before {
    content: "\f590";
    font-size: 26px;
}
.fa-envelope-open-text:before {
    content: "\f658";
    font-size: 24px;
}
.p_head{
 margin-left: 160px;
}
.btn-home {
    background: #1549a5;
    color: #fff;
    font-weight: 700;
    padding: 14px 28px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 20px rgba(255, 119, 0, 0.4);
        position: absolute;
    margin-left: 50%;
}

@media (max-width: 480px) {
    .title-text h1{
        font-size: 17px;
        margin-left: 122px;
    }
      .p_head{
            font-size: 11px;
            margin-left: 122px !important;
      }
      .logo-img{
        height: 105px !important;
      }
      .btn-home{
     background: #1549a5;
    color: #fff;
    font-weight: 600;
    padding: 6px 7px;
    border-radius: 7;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 20px rgba(255, 119, 0, 0.4);
    position: absolute;
    width: 91px;
    height: 36px;
    top: 90px;
    left: 77px;
      }
}


</style>
<body>
      @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
<div class="approval-banner">

    <!-- HEADER -->
    <div class="banner-header">
        <div class="banner-title">
            <img src="https://partsfinder.ae/storage/logo/44444.png" class="logo-img">
            <div class="title-text">
                <h1>Fast Approval Request</h1>
                <p class="banner-subtitle p_head">
                  <strong>Urgent supplier approval required</strong>  
                </p>
            </div>
            
            <button class="btn btn-home" onclick="window.location.href='/'">
    <i class="fas fa-home"></i> Home
</button></a>
        </div>
        
    </div>

    <!-- CONTENT -->
    <div class="banner-content">

        <!-- MESSAGE -->
        <div class="message-section">
            <div class="sect">
                <i class="fas fa-envelope-open-text"></i>
                <h2>Supplier Message</h2>
            </div>

            <div class="message-text">


 <strong> Hello Supplier,
If you want a fast approval, please contact us.<br> Thank you for using our platform!</strong> 
            </div>

            <div class="supplier-info">
                <div class="supplier-avatar">PF</div>
                <div>
                    <h3>Parts Finder UAE</h3>
                    <p>Trusted Partner</p>
                </div>
            </div>
        </div>

        <!-- CONTACT -->
        <div class="contact-section">
            <div class="sect">
                <i class="fas fa-headset"></i>
                <h2>Contact Us</h2>

            </div>

            <div class="contact-item">
                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                <div>
                    <small>Phone</small>
                    <div>+971502566002</div>
                </div>
            </div>

           
  <button class="btn btn-primary"  onclick="contactSupplier('+971502566002')">
    <i class="fab fa-whatsapp"></i> Whatsapp Message Now
</button>
            <div class="response-time">
            <i class="fas fa-bolt"></i> Response within 30 Minutes
        </div>
        </div>

    </div>

    <!-- FOOTER -->
   

</div>

<script>
function approveNow(){
    alert('Approval submitted successfully');
}
function callNow(){
    window.location.href = 'tel:+971502566002';
}
 
        function contactSupplier(whatsapp) {
                const cleanWhatsapp = whatsapp.replace(/\D/g, '');
                window.open(`https://wa.me/${cleanWhatsapp}`, '_blank');
          
        }
  
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>