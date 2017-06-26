<head>
    <title>微信在线报修</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
	<link rel="stylesheet" href="/css/style.css" /> 
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
</head>
<!-- Form -->
<div data-role="page" id="page2">
<div data-theme="a" data-role="header">
<a href="home.php?openid=<?php echo $_GET["openid"];?>" data-role="button" data-inline="true" data-icon="home" data-iconpos="notext" data-ajax="false"> Default panel</a>   
        <h3 id="header">
           我要评价
        </h3>
<a href="" data-role="button" data-rel="back" data-inline="true" data-icon="arrow-l" data-iconpos="notext" data-ajax="false" > Default panel</a>   
    </div>
     
   <div data-role="content">
<form id="myform" name="myform" action="review-update.php?id=<?php echo $_GET["id"];?>&openid=<?php echo $_GET["openid"];?>" method="post"  data-ajax="false" onsubmit = "return check();">                              
        <div data-role="fieldcontain">
<fieldset data-role="controlgroup">
  <legend>您对我们的服务满意吗？</legend>
  <input type="radio" name="review" id="radio-choice-1" value="非常满意" checked="checked" />
  <label for="radio-choice-1">非常满意</label>
 
  <input type="radio" name="review" id="radio-choice-2" value="满意" />
  <label for="radio-choice-2">满意</label>
 
  <input type="radio" name="review" id="radio-choice-3" value="基本满意" />
  <label for="radio-choice-3">基本满意</label>
 
  <input type="radio" name="review" id="radio-choice-4" value="不满意" />
  <label for="radio-choice-4">不满意</label>
</fieldset>
        </div>
		<br>
		<br>
        <input id="sub" name="sub" type="submit" value="提交">
</form>     
    </div>	
      		<div data-role="panel" id="rightpanel" data-theme="b"  data-position="right">  
				
			<div class="panel-content"> 
<input name="" id="searchinput2" placeholder="" value="" type="search">
			</div> <!-- /content wrapper for padding -->  				
		</div> <!-- /leftpanel --> 
	
<div data-role="footer" data-position="fixed" data-tap-toggle="false" data-position="fixed" data-tap-toggle="false">    
<div data-role="navbar" data-iconpos="top" data-theme="a">
        <ul>
            <li>
                <a href="home.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="home">
                    报修广场
                </a>
            </li>
            <li>
                <a href="form.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="edit">
                    我要报修
                </a>
            </li>
            <li>
                <a href="my.php?openid=<?php echo $_GET["openid"];?>" data-ajax="false" data-transition="none" data-theme="a" data-icon="info">
                    我的报修
                </a>
            </li>
        </ul>
</div>
 </div>	
    
</div>   

