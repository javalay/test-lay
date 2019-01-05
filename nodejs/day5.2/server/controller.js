//直接处理暴露出去处理任务的函数
//获取数据库的模块
const conn=require('./db.js')
//测试数据获取
module.exports={
    //对接口的检查操作
    gettest:(req,res)=>{
        res.send('请求后台API接口成功')
    },
    //获取英雄操作
    getahero:(req,res)=>{
        const sql='select *from heros'
        conn.query(sql,(err,result)=>{
            if(err) return res.send({status:500,msg:err.message,data:null})
            res.send({status:200,msg:'ok',data:result})
        })
    },
    //添加英雄操作
    addhero:(req,res)=>{
        // body-parser  要添加这个模块，前台post表单获取提交过来的数据
        const hero =req.body
        const dt=new Date().toLocaleString()
        //获取具体时间的的操作
        // const y=dt.getFullYear()
        // const m=(dt.getMonth()+1).toString().padStart(2,'0')
        // const d=dt.getDate().toString().padStart(2,'0')
    
        // const hh=dt.getHours().toString().padStart(2,'0')
        // const mm=dt.getMinutes().toString().padStart(2,'0')
        // const ss=dt.getSeconds().toString().padStart(2,'0')
    
        // hero.ctime=y+'-'+m+'-'+d+' '+hh+':'+mm+':'+ss
        console.log(dt)
        hero.ctime=dt
        const sql='insert into heros set ?'
        conn.query(sql,hero,(err,result)=>{
            if(err) return res.send({ status:500, msg:err.message, data:null})
            res.send({status:200,msg:'ok',data:result})
        })
    },
    //根据id获取英雄信息---这是另一种传递参数的方式
    gethero:(req,res)=>{
        const id=req.params
        console.log(req.params)
        const sql='select *from heros where id=?'
        conn.query(sql,[id.id],(err,result)=>{
            if(err) return res.send({status:500,msg:err.message,data:null})
            res.send({status:200,msg:'ok',data:result})
        })
    },
    //--------------根据id修改英雄----------------
    alter:(req,res)=>{
        const id=req.params.id
        // const user={name:'后羿',gender:'男'}
        //获取post请求获取前台 表单发过来的数据
        const user=req.body
        const sqlStr='update heros set ? where id= ?'
        conn.query(sqlStr,[user,id],(err,result)=>{
            if(err)return res.send({ status:500, msg:err.message, data:null})
            res.send({status:200,msg:'ok',data:result})
        })
    },
    //-------------根据id软删除------------
    del:(req,res)=>{
        const id=req.params.id
        console.log(id)
        const sqlStr1='update heros set isdel=1 where id=?'
        conn.query(sqlStr1,id,(err,result)=>{
            if(err)return res.send({ status:500, msg:err.message, data:null})
            res.send({status:200,msg:'ok',data:result})
        })
    }
}