(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

let app = new Vue({
    el: '#app',
    components: {
        'ig-media': {
            template: `
                    <div class="col-3">
                        <div class="card row__card">
                            <img class="card-img-top" :src="media.media_url" :alt="media.caption || 'Подпись не завезли(('">

                            <div class="card-body">
                                <p class="card-text">{{ media.caption || 'Подпись не завезли((' }}</p>

                                <div>
                                    <span class="badge badge-secondary">Лайков: {{ media.like_count }}</span>
                                    <span class="badge badge-secondary">Комментариев: {{ media.comments_count }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
            `,
            props: {
                media: Object,
            },
        },
    },
    data: {
        isNextStep: false,
        accessToken: '',

        user: {
            name: 'John Dow',
            picture: 'https://fakeimg.pl/50x50',
        },
        accounts: [],
    },

    methods: {
        async whenLoggedIn() {
            const info = await this.fetchInfo();

            this.user = info.user;
            this.accounts = info.instagram_accounts;

            this.isNextStep = true;
        },

        fetchInfo() {
            return new Promise(resolve => {
                axios.get('/associated-data/'+this.accessToken)
                    .then(response => resolve(response.data))
            })
        },

        checkLoginState() {
            FB.getLoginStatus((response) => {
                if (response.status === 'connected') {
                    this.accessToken = response.authResponse.accessToken;
                    this.whenLoggedIn(response);
                }

                console.log(response);
            });
        }
    },

    mounted() {
        window.fbAsyncInit = () => {
            FB.init({
                appId      : '743594913051145',
                cookie     : true,
                xfbml      : true,
                version    : 'v7.0'
            });

            this.checkLoginState();
        }
    }
})