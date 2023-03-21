
tableHighLight = function(){
    var ColorNormal = 'rgb(248,250,252)';
    var ColorDarker = 'rgb(220,220,220)';

    function Colorize(e){
        e.target.style.backgroundColor = ColorDarker;
        let parent = e.target.closest(".rowcolor");
        let kids = parent.querySelectorAll(".color");
        for(let i=0; i<kids.length;i++){
            kids[i].style.backgroundColor = ColorDarker;
        }
    };

    function Decolorize(e){
        e.target.style.backgroundColor = ColorNormal;
        let parent = e.target.closest(".rowcolor");
        let kids = parent.querySelectorAll(".color");
        for(let i=0; i<kids.length;i++){
            kids[i].style.backgroundColor = ColorNormal;
        }
    };

    var el = document.querySelectorAll(".color");
    el.forEach(elo => {
        elo.addEventListener('mouseover', Colorize);
        elo.addEventListener('mouseout', Decolorize);
    });
}

