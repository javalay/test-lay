<template>
  <div>
    <h1>这是 App 哈哈 组件{{msg}}====={{name}}</h1>
    <input type="button" value="按钮" @click="show">
    <mt-button type="default" size="large">default</mt-button>
    <mt-button type="primary" disabled>primary</mt-button>
    <mt-button type="danger" disabled  icon="more">danger</mt-button>
    <router-link to="/account">accout</router-link>
    <router-link to="/title">title</router-link>
    <router-view></router-view> 
  </div>
</template>

<script>
export default {
  data(){
    return {
      msg:1111,
      name:"嘎嘎嘎"
    }
  },
  methods:{
    show(){
      console.log(this.msg)
    }
  }
}
export var title="李拴蛋"
</script>

<style>

</style>
