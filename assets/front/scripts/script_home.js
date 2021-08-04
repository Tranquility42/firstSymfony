let page=1;

let content = document.querySelector('.content');
let isFetching = false ;
let hasMoreData = true ;

window.onscroll = function() {
    let d = document.documentElement;
    let offset = d.scrollTop + window.innerHeight;
    let height = d.offsetHeight;
    if (hasMoreData === true){
        if (offset >= height) {
            fetchData();
            console.log('At the bottom');
        }
    }

};

fetchData();

function fetchData(){
    isFetching=true;
    fetch('/test-test-ajax?page='+ page)
        .then(result => result.json())
        .then((data) => {
            console.log(data);
            content.insertAdjacentHTML('beforeend',data.html);
            isFetching=false;
            if(date.html === ''){
                hasMoreData =false ;
            }
        });
    page++;

}