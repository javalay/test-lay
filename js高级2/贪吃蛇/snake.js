(function () {
    var position = "absolute";

    function Snake(options) {
        //蛇节的大小
        options = options || {};
        this.width = options.width || 20;
        this.height = options.height || 20;
        //蛇动方向
        this.direction = options.direction || "right";
        //蛇的身体 第一个是蛇头
        this.body = [{
                x: 3,
                y: 2,
                color: "red"
            },
            {
                x: 2,
                y: 2,
                color: "blue"
            },
            {
                x: 1,
                y: 2,
                color: "blue"
            },
        ];
        this.map = map;
    }
    var elements = [];
    Snake.prototype.rander = function () {
        //删除数组中的元素，从最后一个开始删除 
        console.log(1);
        
        for (var i = elements.length - 1; i >= 0; i--) {
            elements[i].parentNode.removeChild(elements[i]);
            elements.splice(i, 1); //这一步是操作数组
            console.log(2);
        }
        //把每一个蛇节渲染到地图上  循环body里面有多少个蛇节
        for (var i = 0, len = this.body.length; i < len; i++) {
            //蛇节--把每一个蛇节赋值给object
            var object = this.body[i];
            var div = document.createElement("div"); //创建蛇的div 和循环次数有关
            elements.push(div); //这里面就是蛇的长度
            this.map.appendChild(div);
            div.style.width = this.width + "px";
            div.style.height = this.height + "px";
            div.style.left = object.x * this.width + "px"; //身体距离左边的距离
            div.style.top = object.y * this.height + "px"; //身体距离上边的距离
            div.style.backgroundColor = object.color;
            div.style.position = position; //脱离文档流
        }
    }
    Snake.prototype.remove = function (food,map) {
        //控制蛇的身体移动，（当前蛇节 到上一个蛇节的位置）
        for (var i = this.body.length - 1; i > 0; i--) { //这是从最后一个div开始的，循环蛇身体中的每一个身体
            this.body[i].x = this.body[i - 1].x; //当前的body的x 赋值给前前的x
            this.body[i].y = this.body[i - 1].y;
        }
        //判断蛇头移动的
        //判断设 移动的方向
        var head = this.body[0]
        switch (this.direction) {
            case "right":
                head.x += 1;
                break; 
            case "left":
                head.x -= 1;
                break;
            case "top":
                head.y -= 1;
                break;
            case "bottom":
                head.y += 1;
                break;
        }
        //判断蛇头是否和食物坐标重合
        headX = that.snake.body[0].x, //获取蛇头的x轴坐标
        headY = that.snake.body[0].y; //获取蛇头的y轴坐标
        var headX = headX * this.width;
        var headY = headY * this.height;
        if (headX === food.x && headY === food.y) {
            // 让蛇增加一节
            // 获取蛇的最后一节
            var last = this.body[this.body.length - 1];
            this.body.push({
                x: last.x,
                y: last.y,
                color: last.color
            });
            // 随机在地图上重新生成食物
            food.rander();
        }
    }
    //暴露构造函数 给外部 就可以访问了
    window.Snake = Snake;
})();
// var map=document.getElementById("map");
// var snake=new Snake(map);
// snake.rander(map);