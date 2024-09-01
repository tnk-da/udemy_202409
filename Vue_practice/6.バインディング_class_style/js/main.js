const app = Vue.createApp({
    data: () => ({
        isLarge: true,
        hasError: true,

        largeClass:"large",
        dangerClass:"textDanger",

        classObject:{
            large:true,
            textDanger:true,
        },

        bgClass:"bgGray",

        color:"blue",
        fontSize:36,

        styleObject:{
            color:"yellow",
            fontSize:"48px"
        }
    }),


}).mount("#app")