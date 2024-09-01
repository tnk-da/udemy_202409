const app = Vue.createApp({
    data: () => ({
      toggle:"true",        //display-cssプロパティを切り替える false=>display:none;
    }),

}).mount("#app")

//v-if
//・高い切り替えコスト
//・要素をDOMから削除,追加

//v-show
//・高い初期描画コスト
//・CSS displayプロパティ