new Vue({
    el: '#app',
    components: {
        Paginate: VuejsPaginate
    },
    data: {
        searchQuery: '',
        channels: [],
        pageNumber: 1,
        pageSize: 10
    },
    computed: {
        filteredChannels() {
            return this.channels.filter(channel => 
                channel.channel_name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
        paginatedChannels() {
            const start = (this.pageNumber - 1) * this.pageSize;
            const end = start + this.pageSize;
            return this.filteredChannels.slice(start, end);
        },
        pageCount() {
            return Math.ceil(this.filteredChannels.length / this.pageSize);
        }
    },
    methods: {
        goToPage(page) {
            this.pageNumber = page;
        }
    },
    created() {
        fetch('../../config/control/get_channel.php')
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
                    this.channels = data;
                } catch (e) {
                    throw new Error(`JSON parse error: ${e.message}`);
                }
            })
            .catch(error => console.error('Error:', error));
    }
});
