const app = Vue.createApp({
data: ()=>({
message:"Hello!",
}), 
computed:{                                                  
    reversedMessage : function(){
        return this.message.split("").reverse().join("")
    }
},
methods: {
    reversedMessageMethod: function(){
        return this. message.split("").reverse().join("")
    }
}

//算出プロパティ　computed プロパティ ()不要　getter,setter　キャッシュ有り..関数を一度実行
//メソッド       methods  メソッド　 ()必要　getter         キャッシュ無し..関数を毎度実行

}).mount("#app")