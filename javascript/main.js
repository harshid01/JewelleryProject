document.addEventListener("DOMContentLoaded", () => {

    function counter(id, start, end, duration) {

        let obj = document.getElementById(id);

        if(!obj){
            return;
        }

        let current = start,
            range = end - start,
            increment = end > start ? 1 : -1,
            step = Math.abs(Math.floor(duration / range));

        let timer = setInterval(() => {

            current += increment;

            obj.textContent = current;

            if(current == end){
                clearInterval(timer);
            }

        }, step);

    }

    counter("count1", 500, 5000, 3000);
    counter("count2", 500, 3000, 2500);
    counter("count3", 1000, 10000, 3000);
    counter("count4", 500, 2000, 3000);

});