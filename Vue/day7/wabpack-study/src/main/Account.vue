<template>
  <div>Account组件
    <router-link to="/login" @click="show">accout111==={{msg}}</router-link>
    <router-link to="/title">title111</router-link>
    <mt-button type="default" size="large" @click="show">default</mt-button>
    <mt-button type="default" size="large" >close</mt-button>
    <button type="button" class="mui-btn mui-btn-primary mui-icon mui-icon-search">{{color}}</button>
    <router-view></router-view>
  </div>
</template>
<script>
import { Toast } from "mint-ui"
export default {
  data() {
    return {
      msg: "zs",
      color:'白色'
    };
  },
  methods: {
    show() {
      console.log(this.msg + "嘎嘎嘎嘎");
    //   Toast("提示信息");
     var  toast=Toast({
        message: "操作成功",
        iconClass: "icon icon-success",
        duration: 50000,
        className:'active'
      });
      setTimeout(function(){
            toast.close()
      },3000)
    }
  }
};
</script>
<style>
</style>