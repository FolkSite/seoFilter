seoFilterConfig = {
    depth: 2,
    slash_at_end: true
};
// Set slider numbers
$(".filter-number").each(function() {
    var filter = $(".mse2_number_slider", this).data('number-filter'),
        re_str = "^(.*)\\/"+filter+"(-|=)(\\d{1,5}),(\\d{1,5})\\/(.*)?$",
        re = new RegExp(re_str),
        match_arr = document.location.pathname.match(re);

    if (match_arr) {
        min = match_arr[3], max = match_arr[4];
        $(".mse2-number-0", this).val(min); $(".mse2-number-1", this).val(max);
        $(mSearch2.options.slider, this).slider('values',0,min); // sets first handle (index 0)
        $(mSearch2.options.slider, this).slider('values',1,max); // sets second handle (index 1)
    }
});

// Set alias filter
mSearch2.Hash.set = function(vars) {
    var hash = '', hash_al = '', hash_get = '';
    var vars_arr = [];
    var curr_path = $(mSearch2.options.wrapper).data('url');
    for (var i in vars) {
        if (vars.hasOwnProperty(i)) {
            vars_arr = vars[i].toString().split(';');

            var alias = $("input[name='"+i+"'][value='"+vars[i]+"']").data("filter-alias");

            if (alias && vars_arr.length == 1 && Object.keys(vars).length <= seoFilterConfig.depth) {
                if(seoFilterConfig.slash_at_end) {
                    hash_al += alias + '/';
                }
                else {
                    hash_al += '/' + alias;
                }
            }
            else {
                hash_get += '&' + i + '=' + vars[i];
            }
        }
    }

    hash_get = hash_get === '' ? '' : '?' + hash_get.substr(1);
    hash = hash_al + hash_get;

    //debugger
    //window.location.assign(curr_path + hash);

    if (!this.oldbrowser()) {
        window.history.pushState({mSearch2: curr_path + hash}, '', curr_path + hash);
    }
    else {
        window.location.hash = hash;
    }
};