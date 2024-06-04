new Vue({
    el: '#app',
    components: {
        Paginate: VuejsPaginate
    },
    data: {
        searchQuery: '',
        threads: [],
        pageNumber: 1,
        pageSize: 10,
        channelId: null,
        channel_name: ''
    },
    computed: {
        filteredThreads() {
            return this.threads.filter(thread => 
                thread.thread_name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
        paginatedThreads() {
            const start = (this.pageNumber - 1) * this.pageSize;
            const end = start + this.pageSize;
            return this.filteredThreads.slice(start, end);
        },
        pageCount() {
            return Math.ceil(this.filteredThreads.length / this.pageSize);
        }
    },
    methods: {
        goToPage(page) {
            this.pageNumber = page;
        },
        getChannelIdFromUrl() {
            const params = new URLSearchParams(window.location.search);
            return params.get('id');
        },
        fetchThreads() {
            fetch(`../../config/control/get_thread.php?channel_id=${this.channelId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text(); // まずテキストとして受け取る
                })
                .then(text => {
                    console.log('Fetched raw text:', text);
                    try {
                        const data = JSON.parse(text); // JSONに変換
                        console.log('Parsed data:', data);
                        if (data.error) {
                            throw new Error(data.error);
                        }
                        this.threads = data;
                    } catch (e) {
                        throw new Error(`JSON parse error: ${e.message}`);
                    }
                })
                .catch(error => console.error('Error:', error));
        },
        fetchChannelname() {
            fetch(`../../config/control/get_channel.php?channel_id=${this.channelId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text(); // まずテキストとして受け取る
                })
                .then(text => {
                    console.log('Fetched raw text:', text);
                    try {
                        const data = JSON.parse(text); // JSONに変換
                        console.log('Parsed data:', data);
                        if (data.error) {
                            throw new Error(data.error);
                        }
                        this.channel_name = data.channel_name;
                    } catch (e) {
                        throw new Error(`JSON parse error: ${e.message}`);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    },
    created() {
        this.channelId = this.getChannelIdFromUrl();
        this.fetchThreads();
        this.fetchChannelname();
    }
});
