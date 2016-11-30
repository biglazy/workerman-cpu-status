<html>
<head>
    <title>workerman-cpu-status</title>
    <script src="js/echarts.min.js"></script>
</head>
<body>
    <h2>workerman-cpu-status</h2>
    <hr/>

    <div id="main" style="width: 600px;height:320px;"></div>


<script type="text/javascript">

function getData() {
    var value = Math.round(Math.random() * 100);
    var now = new Date();
    return {
        name: now.toString(),
        value: [
            now.toString(),
            value
        ]
    };
}

var my_chart = echarts.init(document.getElementById('main'));
var data = [];
var length = 1;

var option = {
    title: {
        text: 'CPU利用率模拟展示'
    },
    tooltip: {
        trigger: 'axis',
        formatter: function (params) {
            return  'Value : ' + params.value[1];
        },
        axisPointer: {
            animation: false
        }
    },
    xAxis: {
        type: 'time',
        splitLine: {
            show: false
        }
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '100%'],
        splitLine: {
            show: false
        }
    },
    series: [{
        name: '模拟数据',
        type: 'line',
        showSymbol: false,
        hoverAnimation: false,
        data: data
    }]
};

my_chart.setOption(option);

setInterval(function () {
    if(length <= 30){
        data[length] = getData();
        length++;
    }else{
        data.shift();
        data.push(getData());
    }

    my_chart.setOption({
        series: [{
            data: data
        }]
    });
}, 1000);
</script>
</body>
</html>
    
