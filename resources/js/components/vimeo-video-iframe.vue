<template>
    <iframe :src="getVimeoVideoUrl"
            width="100%"
            height="300px"
            frameborder="0"
            webkitallowfullscreen
            mozallowfullscreen
            allowfullscreen>
    </iframe>
</template>

<script>
    export default {
        name: "vimeo-video-iframe",
        data(){
            return{
                player: null,
                time: 0,
                timerID: null,
                lesson_id: null
            }
        },
        props: {id: String},
        computed:{
            getVimeoVideoUrl(){
                return "https://player.vimeo.com/video/"+this.id
            }
        },
        methods:{
            updateTime() {
                this.time += 1;

                if(this.time > 9 && this.time%5 === 0) {

                    axios.post("/userStatus/updateDuration",
                        {
                            "lesson_id" : this.lesson_id,
                            "duration": this.time
                        })
                        .then(res => {
                            this.time = 0;
                        });
                }
            },

            listenOn() {
                this.player.on('play', () => {
                    this.timerID = setInterval(this.updateTime, 1000);
                });
            },

            listenPause() {
                this.player.on('pause', () => {
                    clearInterval(this.timerID);
                });
            },

            connect(){
                this.player.getDuration().then( duration => {
                    axios.post("/userStatus/updateDuration",
                        {
                            "lesson_id" : this.lesson_id,
                            "duration": this.time,
                            "max_duration": duration
                        });
                });
            },

            getLessonId() {
                // В этом блоке узнаем, lesson_id из URL
                let url = window.location.href;
                let parts_url = url.split('/');
                this.lesson_id = parts_url[parts_url.length-1];
            }
        },
        mounted() {

            this.player = new Vimeo.Player(this.$el);

            this.getLessonId();

            this.listenOn();

            this.listenPause();

            this.connect();

        }
    }
</script>

<style scoped>

</style>
