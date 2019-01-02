const m1=require('./m1.js')
console.log(m1.a);
console.log(m1.say());
const say=m1.say
console.log(say);
console.log(exports)//{}  空对象
console.log(exports==={})  //false
console.log({}==={})  //false
console.log(module)