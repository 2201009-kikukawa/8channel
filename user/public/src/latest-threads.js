document.addEventListener('DOMContentLoaded', function () {
    new Vue({
        el: '#app',
        components: {
            Paginate: VuejsPaginate
        },
        data: {
            tags: [],
            tag_name: '', // 初期値を設定
            searchQuery: '',
            threads: [],
            currentPage: 1,
            perPage: 10,
            allThreads: [] // 全てのスレッドを保持するためのプロパティ
        },
        computed: {
            filteredThreads() {
                if (this.searchQuery) {
                    return this.threads.filter(thread =>
                        thread.thread_name.includes(this.searchQuery)
                    );
                }
                return this.threads;
            },
            paginatedThreads() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.filteredThreads.slice(start, end);
            },
            pageCount() {
                return Math.ceil(this.filteredThreads.length / this.perPage);
            }
        },
        methods: {
            goToPage(page) {
                this.currentPage = page;
            },
            fetchTags() {
                fetch('../../config/control/get_tags.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(text => {
                        console.log('Fetched raw text:', text);
                        try {
                            const data = JSON.parse(text);
                            console.log('Parsed data:', data);
                            if (data.error) {
                                throw new Error(data.error);
                            }
                            this.tags = data;
                        } catch (e) {
                            throw new Error(`JSON parse error: ${e.message}`);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            },
            fetchThreads() {
                fetch('../../config/control/get_latest.php')
                    .then(response => response.json())
                    .then(data => {
                        this.threads = data;
                        this.allThreads = data; // 全てのスレッドを保持
                    })
                    .catch(error => console.error('Error:', error));
            },
            filterThreadsByTag(tagId,tagName) {
                fetch(`../../config/control/get_latest.php?tag_id=${tagId}`)
                    .then(response => response.json())
                    .then(data => {
                        this.threads = data;
                        this.currentPage = 1; // ページを最初に戻す
                        this.tag_name = tagName;
                    })
                    .catch(error => console.error('Error:', error));
            }
        },
        created() {
            this.fetchTags();
            this.fetchThreads();
        }
    });
});
