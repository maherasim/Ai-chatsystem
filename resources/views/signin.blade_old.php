<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css2?family=Genos:wght@400;600;700&display=swap" rel="stylesheet">

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>LogiTeam - Work Intelligently</title>

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Genos',sans-serif;
    background:#f4f5f7;
}

/* HEADER */
.header{
    width: 100%;              /* full page width */
    background: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 20px;
}

.header-inner {
    max-width: 1400px;        /* same as wrapper max-width */
    margin: 0 auto;           /* center it */
    padding: 0 20px;          /* side padding */
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
}
.header-left{display:flex;align-items:center;gap:14px;}
.header-right {
    display: flex;
    align-items: center;
    gap: 15px;
    background: #fff;
    padding: 10px 20px;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    flex-shrink:0;
}

.login-btn{
    border:none;
    background:none;
    font-size:14px;
    font-weight:600;
    color:#333;
    cursor:pointer;
}
.signup-btn{
    padding:10px 20px;
    border-radius:20px;
    background:#00c85c;
    color:#fff;
    border:none;
    cursor:pointer;
    font-size:14px;
    font-weight:600;
}

/* HEADER CENTER */
.header-center{
    text-align:left;
    margin-top:10px;
      max-width: 1400px;        /* same as wrapper max-width */
    margin: 0 auto;   
}
.tagline{font-size:22px;font-weight:600;color:#333;}
.subtitle{font-size:12px;color:#777;margin-top:4px;}
.line-text {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
}
.line-text .line {
    flex: 1;
    height: 1px;
    background: #000;
    max-width: 119px;
}

/* MAIN WRAPPER */
.wrapper {
  max-width: 1400px;
  margin: 35px auto;
  padding: 0 20px;
  display: flex;
  gap: 30px;
  flex-wrap: wrap; /* allow wrapping on small screens */
}

/* SIDEBAR */
.sidebar {
    width: 100%;
    max-width: 250px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    flex-shrink: 0;
}

/* CARD */
.side-card {
    position: relative;
    padding: 20px;
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    cursor: pointer;
    min-width: 150px;
}

/* BACKGROUND COLORS */
.bg-projects { background: rgba(248, 251, 231, 1); }
.bg-tickets  { background: rgba(255, 229, 235, 1); }
.bg-time     { background: rgba(252, 242, 254, 1); }

/* ICONS */
.side-icon {
    width: 55px;
    height: 55px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.side-icon img {
    width: 63px;
    height: 63px;
}

/* TEXT */
.side-text {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    line-height: 1.2;
    word-break: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    text-align: left;
}

/* ARROW ICON */
.arrow-icon-small {
    position: absolute;
    right: 10px;
    bottom: 10px;
    width: 62px;
    height: 62px;
    opacity: 0.7;
}

/* HERO */
.heros {
    flex:1;
    min-width: 300px;
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}
.hero-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: bottom right; /* ensures bottom-right is visible */
}

/* Arrow button */
.arrow-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 99;
    border: 1px solid #32BFFD;
    border-radius: 30px;
    padding: 11px;
}
.arrow-btn img {
    width: 20px;
    height: auto;
    cursor: pointer;
}

/* RESPONSIVE */
@media(max-width:1100px){
    .wrapper{
        flex-direction: column;
        align-items: center;
        padding: 0 15px;
    }
    .sidebar{
        max-width: 100%;
        width: 100%;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
    }
    .side-card{
        width: 45%; /* two cards per row */
        margin-bottom: 20px;
    }
    .heros{
        width: 100%;
        min-width: unset;
        height: 400px;
    }
}
@media(max-width:768px){
    .side-card{
        width: 100%; /* one card per row */
    }
    .hero-top{
        height: 350px;
    }
    .tagline{
        font-size: 20px;
    }
}
</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="header-inner">
        <div class="header-left">
            <div class="logo-icon">
                <img src="{{URL::asset('/build/img/Frame 1171277407.png')}}"/>
            </div>
        </div>
        <div class="header-right">
            <button class="login-btn">Login</button>
            <button class="signup-btn">Login Here</button>
        </div>
    </div>

    <div class="header-center">
        <div class="tagline">Work intelligently. Perform efficiently</div>
        <div class="line-text">
            <span>Powered By</span>
            <div class="line"></div>
            <span>LogiTech</span>
        </div>
    </div>
</div>

<!-- WRAPPER -->
<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="side-card bg-projects">
            <div class="side-icon icon-projects">
                <img src="{{URL::asset('/build/img/Group 1618874103.png') }}">
            </div>
            <div class="side-text">Manage your Projects</div>
            <img class="arrow-icon-small" src="{{URL::asset('/build/img/Auto Layout Horizontal.png') }}">
        </div>

        <div class="side-card bg-tickets">
            <div class="side-icon icon-tickets">
                <img src="{{URL::asset('/build/img/editor.png') }}">
            </div>
            <div class="side-text">Manage your Tickets</div>
            <img class="arrow-icon-small" src="{{URL::asset('/build/img/Auto Layout Horizontal.png') }}">
        </div>

        <div class="side-card bg-time">
            <div class="side-icon icon-time">
                <img src="{{URL::asset('/build/img/clock.png') }}">
            </div>
            <div class="side-text">Manage your Time</div>
            <img class="arrow-icon-small" src="{{URL::asset('/build/img/Auto Layout Horizontal.png') }}">
        </div>
    </div>

    <!-- HERO -->
    <div class="heros">
        <img class="hero-top" src="{{URL::asset('/build/img/HERO.png') }}">
        <div class="arrow-btn">
            <img src="{{URL::asset('/build/img/arrow-up-right.png') }}">
        </div>
    </div>

</div>

