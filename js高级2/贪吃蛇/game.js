(function () {
    function Game(map) {
        this.food = new Food(map); //食物对象
        this.snake = new Snake(map); //蛇对象
        this.map = map;
        that = this;
    }
    Game.prototype.start = function () {
        //1 把蛇和食物对象，渲染到地图上面
        this.food.rander();
        this.snake.rander();
        // 2 开始游戏的逻辑
        // 2.1  让蛇移动起来
        // 2.2  当蛇遇到边界游戏结束
        runSnake();
        // 2.3  通过键盘控制蛇移动的方向
        binKey();
        // 2.4  当蛇遇到食物  
    }
    //私有函数， 让蛇移动
    function runSnake() { 
        var timeId = setInterval(function () {
            //这里的this指的是window
            // console.log(this);
            that.snake.remove(that.food,that.map);
            that.snake.rander();
            //当蛇遇到边界游戏结束
            //获取蛇头的坐标
            var maxX = that.map.offsetWidth / that.snake.width, //获取X轴最大可以取什么值
                maxY = that.map.offsetHeight / that.snake.height, //获取Y轴最大可以取什么值
                headX = that.snake.body[0].x, //获取蛇头的x轴坐标
                headY = that.snake.body[0].y; //获取蛇头的y轴坐标
            if (headX < 0 || headX >= maxX) { //判断是否小于零  蛇头坐标X大于等于可取X最大坐标
                alert("Game Over");
                clearInterval(timeId);
            }
            if (headY < 0 || headY >= maxY) {
                alert("Game Over");
                clearInterval(timeId);
            }
        }, 90);
    }
    function binKey() {
        //左37 上38 下40 右39  判断点击的是哪个键盘
        document.addEventListener("keydown", function (e) {
            console.log(that);
            switch (e.keyCode) {
                case 37:
                    that.snake.direction = "left";
                    break;
                case 38:
                    that.snake.direction = "top";
                    break;
                case 39:
                    that.snake.direction = "right";
                    break;
                case 40:
                    that.snake.direction = "bottom";
                    break;
            }
        }, false);
    }
    //2 开始游戏逻辑
    //暴露构造函数给外部
    window.Game = Game;
    //测试
})();
// (function () {
//     var map = document.getElementById('map');
//     var game = new Game(map);
//     game.start();
//   })()