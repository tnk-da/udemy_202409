const app = Vue.createApp({
    data: () => ({
        km: 0,
        m: 0,

        colors: [
            { name: "red" },
            { name: "green" },
            { name: "blue" }
        ]
    }),
    watch: {
        km: function (value) {
            console.log(value)
            this.km = value
            this.m = value * 1000
        },
        m: function (value) {
            this.m = value
            this.km = value / 1000
        },

        colors: {
            handler: function (newValue, oldValue) {
                console.log("update!!")
            },
            deep: true
        }
    },
    methods: {
        onClick: function (event) {
            this.colors[1].name = "white"
        }
    }
}).mount("#app")