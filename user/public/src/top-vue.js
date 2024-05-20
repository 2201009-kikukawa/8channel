new Vue({
    el: '#app',
    data: {
        searchQuery: '',
        threads: []
    },
    computed: {
        filteredThreads() {
            return this.threads.filter(thread => 
                thread.thread_name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        }
    },
    created() {
        fetch('../../config/control/get_thread.php')
            .then(response => response.json())
            .then(data => {
                this.threads = data;
            })
            .catch(error => console.error('Error:', error));
    }
});
