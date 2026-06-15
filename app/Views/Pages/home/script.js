
history.scrollRestoration = "manual";
function infiniteList() {
    return {
        items: [],
        page: 2,
        loading: false,
        hasMore: true,
        observer: null,

        async loadMore() {
            if (this.loading || !this.hasMore) return;
            

            this.loading = true;

            try {
                const response = await fetch(
                    `http://localhost/behyab/api/schema/${this.page}`
                );

                const data = await response.json();
                console.log('data is : ',data);
                
                if (data.hasMore === false) {
                    
                    this.hasMore = false;
                    this.observer.disconnect();
                    this.observer = null;
                    return;
                }

                this.items.push(...data.data);
                console.log('items : ',this.items);
                
                this.page++;
            } catch (error) {
                console.error(error);
            } finally {                
                this.loading = false;
            }
        },

init() {
    //this.loadMore();    
    
    this.observer = new IntersectionObserver(
        (entries) => {

            const entry = entries[0];

            if (entry.isIntersecting && !this.loading) {                
                this.loadMore();
            }
        },
        {
            rootMargin: '50px',
            threshold:0.1
        }
    );

    this.$nextTick(() => {
        if (this.$refs.loader) {
            this.observer.observe(this.$refs.loader);            
            
            

       }
    });
}


    }
}