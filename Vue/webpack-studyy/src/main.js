
import $ from "jquery"
import "./css/index.css"
import "./css/index.less"
import '../node_modules/bootstrap/dist/css/bootstrap.css'
class Person{
    static info={name:'zs',age:20}
}
function Person1(name){
    this.name=name
}
var p1=new Person1('李拴蛋')
console.log(Person.info);
console.log("=========");
console.log(p1.name)

$(function(){
    $('li:odd').css("backgroundColor","green")
    $('li:even').css("backgroundColor","yellow")
})