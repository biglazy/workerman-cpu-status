<html>
<head>
    <title>workerman-cpu-status</title>
    <!-- 引入样式 -->
    <link href="//cdn.bootcss.com/element-ui/1.0.3/theme-default/index.css" rel="stylesheet">
    <!-- 引入组件库 -->
    <script src="//cdn.bootcss.com/vue/2.1.3/vue.min.js"></script>
    <script src="//cdn.bootcss.com/element-ui/1.0.3/index.js"></script>
    <style>
        #app {width:400px;} 
    </style>
</head>
<body>
    <h2>workerman-cpu-status</h2>
    <hr/>

    <p>CPU利用率</p>
    <div id="app">
        <el-progress :text-inside="true" :stroke-width="18" :percentage="percent" status="success"></el-progress>
    </div>

    <script type="text/javascript">
        var cpu_app = new Vue({
            el:'#app',
            data: {
                percent:50
            }
        });

		var ws = new WebSocket('ws://127.0.0.1:1234'); 
		ws.onopen = function(event){
			console.log('Connected to websocket server.');
			ws.send(JSON.stringify({route:'cpu_status',request:''}));
		};
		ws.onclose = function(event){
			console.log('Disconnected.');
		};
		ws.onmessage = function(event){
			console.log('Retrieved data from server:'+event.data);
            var data = JSON.parse(event.data);
            if(data.type == 'cpu_status'){
                cpu_app.percent = data.data;
            }
		};
        ws.onerror = function(event,e){
            console.log('Error occured: '+event.data);
        };

    </script>
</body>
</html>
