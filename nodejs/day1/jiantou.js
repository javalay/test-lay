function add(x,y){
    return x+y;
}
(x,y)=>{
    return x+y;
}
//把函数 赋值给addd对象
var addd =(x,y)=>{
    return x+y
}
console.log(addd(1,2))

//如果左侧参数只有一个 可以省略小括号 
var addd = x =>{
    return x+100
}
console.log(addd(1))

//如果 右侧的花括号省略， 那么return 也会被省略
var addd = x => x+1000
console.log(addd(1))

let arr=[1,2,3].map(x => x*x)
console.log(arr) //[ 1, 4, 9 ]


let name='zs'
let age=20
function show(){
    console.log('我是zs')
}
//引用方法和对象
var person={
    name,
    age,
    show,
    say: (x) =>  x*x
}
console.log(person);
