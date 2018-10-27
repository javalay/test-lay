(function(window,undefined){
  var Tools = {
    getRandom: function (min, max) {
      return Math.floor(Math.random() * (max - min + 1)) +  min;
    }
  }
  window.Tools=Tools;
})(window,undefined);

//自调用函数传入window的目的，是让变量可以被压缩
// 在老版本的浏览器中undefined 可以被重新赋值