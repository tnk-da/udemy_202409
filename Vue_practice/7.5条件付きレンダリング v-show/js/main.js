const app = Vue.createApp({
    data: () => ({
        counter: 0,
        message: ''
    }),
    methods: {
        clickHandler: function (event) {
            console.log(event.target.tagName),
                console.log(event.target.innerHTML),
                console.log(event.target.type),
                console.log(event.target.id),
                this.counter++
        },
        clickMethod: function ($event, message) {
            console.log(message),
                this.message = message
            console.log($event.target.type)
        },
        clickOnce: function () {
            this.message = new Date().toLocaleTimeString()
        }
    }

}).mount("#app")
