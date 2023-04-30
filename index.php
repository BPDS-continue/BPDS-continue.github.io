<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>FredTools IDE</title>
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      function runcode(code,type)
      {
        if(type == "python")
        {
          console.log(code);
          var xmlhttp;
          if (window.XMLHttpRequest)
          {
            //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
          }
          else
          {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.open("GET","http://ide.ft2.club/api/python.php?code=" + escape(code),false);
          xmlhttp.send();
          var data = xmlhttp.responseText;
          $("#output").html("<pre class=\"fillall\">" + data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br>") + "</pre>");
        }
        if(type=="html")
        {
          $("#output").html('<iframe style="width=100%;height=100%;" id="iframe" class="fillall" src="http://ide.ft2.club/api/mirror.php?code=' + escape(editor.getValue()) + '"></iframe>');
        }
        if(type == "php")
        {
          console.log(code);
          var xmlhttp;
          if (window.XMLHttpRequest)
          {
            //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
          }
          else
          {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.open("GET","http://ide.ft2.club/api/php.php?code=" + escape(code),false);
          xmlhttp.send();
          var data = xmlhttp.responseText;
          $("#output").html("<pre class=\"fillall\">" + data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br>") + "</pre>");
        }

      }
    </script>
    <style type="text/css" media="screen">
      #editor {
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
      }
      .container {
        margin: 0;
        //position: absolute;
        top: 0;
        bottom: 0;
      }
      #editordiv {
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left:0;
        right:58.33333333333334%;
      }
      #iframediv {
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 50%;
        left: 41.66666666666667%;
        right:16.66666666666667%;
      }
      #stepdiv {
        margin: 0;
        position: absolute;
        top: 50%;
        bottom: 0;
        left: 41.66666666666667%;
        right:16.66666666666667%;
      }
      .col-md-2 {
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 83.33333333333334%;
        right:0;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="col-md-5 column" id="editordiv">
        <pre id="editor"></pre>
      </div>
      <div class="col-md-5 column" id="iframediv">
        <h3>运行结果：</h3>
        <div id="output"></div>
      </div>
      <div class="col-md-5 column" id="stepdiv">
        <h3 id="stepcount">自由模式</h3>
        <p id="steptext">在此模式下，你可以自由的使用FredTools IDE。</p>
        <p id="task">任务：无</p>
      </div>
      <div class="col-md-2 column">
        <!-- 更改语言-start -->
        <div class="form-group">
          <select name="language" id="language" class="form-control">
            <option value="python" selected>Python（.py）</option>
          </select>

          <button id="changelang" class="btn btn-default">
            更改语言
          </button>
        </div>
        <!-- 更改语言-end -->
        <br>
        <!-- 更改皮肤-end -->
        <div class="form-group">
          <select name="skin" id="skin" class="form-control">
            <?php require "../skin.html"; ?>
          </select>
          <button id="changeskin" class="btn btn-default">
            更改皮肤
          </button>
        </div>
        <!-- 更改语言-end -->
        <button class="btn btn-default" id="cheak">
          <span class="glyphicon glyphicon-play-circle"></span>运行代码
        </button>
        <br><br>
        <div class="form-group">
          <input type="text" id="filename" placeholder="请输入此文件文件名......" class="form-control">
          <button class="btn btn-default" id="savecode">
            <span class="glyphicon glyphicon-save"></span>保存代码（通过Cookie）
          </button>
          <button class="btn btn-default" id="readcode">
            <span class="glyphicon glyphicon-open"></span>读入代码（通过Cookie）
          </button>
        </div>
      </div>
    </div>
    <script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
      var editor = ace.edit("editor");
      editor.setOptions({enableLiveAutocompletion: true});
      editor.setTheme("ace/theme/Chrome");
      editor.session.setMode("ace/mode/python");
      $("#changelang").click(function(){
        editor.session.setMode("ace/mode/" + $("#language").val());
      });
      $("#changeskin").click(function(){
        editor.setTheme("ace/theme/" + $("#skin").val());
      });
      $("#cheak").click(function(){
        var result = runcode(editor.getValue(), $("#language").val());
      });
      $("#savecode").click(function(){
        $.cookie("File-" + $("#filename").val(), editor.getValue());
      });
      $("#readcode").click(function(){
        editor.setValue($.cookie("File-" + $("#filename").val()));
      });
    </script>
  </body>
</html>
