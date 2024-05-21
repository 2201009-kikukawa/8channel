new Vue({
    el: '#app',
    components: {
        Paginate: VuejsPaginate
    },
    data: {
        searchQuery: '',
        threads: [],
        pageNumber: 1,
        pageSize: 10
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
        }
    },
    created() {
        fetch('../../config/control/get_thread.php')
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
    }
});
