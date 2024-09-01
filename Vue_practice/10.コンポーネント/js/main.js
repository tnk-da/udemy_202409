//ローカル登録
// const helloComponent = {
//     template: '<p>Hello!</p>'
// }

const buttonCounter = {
    template: '<div><span>count: </span><button v-on:click="countUp">{{count}}</button></div>',
    data: () => ({
        count: 0
    }),
    methods: {
        countUp: function (event) {
            this.count++
        }
    }
}

const app = Vue.createApp({
    data: () => ({


    }),
    //ローカル登録
    // components: {
    //     'hello-component': helloComponent
    // }
    components:{
        'button-counter':buttonCounter
    }

})

// グローバル登録
// app.component('hello-component',{
//     template: '<p>Hello!</p>'
// })

app.mount("#app")