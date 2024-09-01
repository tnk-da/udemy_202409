const app = Vue.createApp({
    data:() => ({
        newItem:"",
        todos:[]
    }),methods:{
        addItem:function(event){
            // console.log("clicked")
            if(this.newItem === "") return              // 入力値が空なら終了
            let todo = {
                item: this.newItem,
                isDone:false
            }
            this.todos.push(todo)
            this.newItem = ""                           //　inputタグ内をリセット
        },
        deleteItem:function(index){
            // console.log("delete")
            // console.log(index)
            this.todos.splice(index,1)                  //　第１引数　削除を始める要素　第２引数　削除する長さ
        }
   
    }
}).mount("#app")