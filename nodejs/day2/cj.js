const fs = require('fs')
let newArr = []
let newSCore=''
fs.readFile(__dirname + '/cj.txt', 'utf-8', function (err, data) {
    if (err) return "读取失败" + err.message
    console.log(data);
    const arr = data.split(' ') //[ '小米=100', '', '', '小红=99', '', '小强=88', '', '王栓蛋=77' ]
    console.log(arr);
    arr.forEach(item => {
        if (item.length > 0) {
            let newSCore = item.replace('=', ':')
            newArr.push(newSCore)
            console.log(newSCore)
        }
    });
    fs.writeFile(__dirname + '/cjs.txt',newArr.join('\n'), 'utf-8',(err) => {
        if (err) return console.log('写入失败，失败原因：' + err.message)
        console.log('写入成功')
    })
    fs.appendFile(__dirname + '/cj.txt', '\n' + newArr.join('\n'), 'utf-8',(err) => {
        if (err) return console.log('追加失败，失败原因：' + err.message)
        console.log('追加成功')
    })
})