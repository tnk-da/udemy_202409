const app = Vue.createApp({
    data: () => ({
        message: 'Hello!',
        number: 100,
        ok: true,
        url:"https://www.google.co.jp/",
    }), methods: {
        clickHandler: function (event) {
            this.message = this.message.split('').reverse().join('')
            // split 文字列を分離＆配列に格納
            // reverse　配列要素の順を逆にする
            // join　配列要素を結合させる(1つの文字列)
        }
    }

}).mount("#app")