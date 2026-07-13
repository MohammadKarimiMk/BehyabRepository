
history.scrollRestoration = "manual";
let a=0;
function infiniteList(rootUrl,category_id) {
    return {
        page: 2,
        loading: false,
        pendingLoad:false,
        hasMore: true,
        observer: null,

        async loadMore() {


            //if (this.loading || !this.hasMore) return;

            if(!this.hasMore)return;

            if(this.loading){
                this.pendingLoad = true;
                return;
            }



            this.loading = true;

            try {
                let url=`${rootUrl}/api/schema/${this.page}/${category_id}`;
                
                const response = await fetch(url);


                const data = await response.json();
                console.log('data is : ',data);
                        

                
                        if (data.html) {
            this.$refs.grid.insertAdjacentHTML(
                'beforeend',
                data.html
            );
        }
                
                a+=data.data.length;


                if (data.hasMore === false) {                    
                    this.hasMore = false;
                    this.observer.disconnect();
                    this.observer = null;
                    return;
                }
                //console.log(a);
                
                
                
                this.page++;
            } catch (error) {
                console.error(error);
            } finally {                
                this.loading = false;

                if (this.pendingLoad) {
                    this.pendingLoad = false;
                    this.loadMore();
                }
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
            rootMargin: '200px',
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