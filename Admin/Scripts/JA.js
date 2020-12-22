$(".details").on("click", function () {
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).prev().prev().prev().slideUp(300);
        $(this).children(":first").text("More Details");
        $(this).children(":last").removeClass("to-up");
        $(this).children(":last").removeClass("fa-angle-up");
        $(this).children(":last").addClass("fa-angle-down");

    } else {
        $(this).addClass("active");
        $(this).prev().prev().prev().slideDown(300);
        $(this).children(":first").text("Less Details");
        $(this).children(":last").removeClass("fa-angle-down");
        $(this).children(":last").addClass("fa-angle-up to-up");
    }
});
$(".reply-btn").on("click", function () {
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).parent().next().slideUp(300);

    } else {
        $(this).addClass("active");
        $(this).parent().next().slideDown(300);
    }
});
$("#advanceBtn").on("click", function () {
    if ($("#advanced").hasClass("active")) {
        $("#advanced").removeClass("active");
        $("#advanced").slideUp(300);

    } else {
        $("#advanced").addClass("active");
        $("#advanced").slideDown({
            start: function () {
                $(this).css({
                    display: "flex"
                })
            }
        });
    }
})

// configure Quill to use inline styles so the email's format properly
var DirectionAttribute = Quill.import('attributors/attribute/direction');
Quill.register(DirectionAttribute, true);

var AlignClass = Quill.import('attributors/class/align');
Quill.register(AlignClass, true);

var BackgroundClass = Quill.import('attributors/class/background');
Quill.register(BackgroundClass, true);

var ColorClass = Quill.import('attributors/class/color');
Quill.register(ColorClass, true);

var DirectionClass = Quill.import('attributors/class/direction');
Quill.register(DirectionClass, true);

var FontClass = Quill.import('attributors/class/font');
Quill.register(FontClass, true);

var SizeClass = Quill.import('attributors/class/size');
Quill.register(SizeClass, true);

var AlignStyle = Quill.import('attributors/style/align');
Quill.register(AlignStyle, true);

var BackgroundStyle = Quill.import('attributors/style/background');
Quill.register(BackgroundStyle, true);

var ColorStyle = Quill.import('attributors/style/color');
Quill.register(ColorStyle, true);

var DirectionStyle = Quill.import('attributors/style/direction');
Quill.register(DirectionStyle, true);

var FontStyle = Quill.import('attributors/style/font');
Quill.register(FontStyle, true);

var SizeStyle = Quill.import('attributors/style/size');
Quill.register(SizeStyle, true);
let fonts = Quill.import("attributors/style/font");
fonts.whitelist = ["initial", "sans-serif", "serif", "monospace", "cabin"];
Quill.register(fonts, true);
var toolbarOptions = [
    ['bold', 'italic', 'underline'],        // toggled buttons

    [{'header': 1}, {'header': 2}],               // custom button values
    [{'list': 'ordered'}, {'list': 'bullet'}],
    [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
    [{'direction': 'rtl'}],                         // text direction

    [{'header': [1, 2, 3, 4, 5, 6, false]}],

    [{'color': []}, {'background': []}],          // dropdown with defaults from theme
    [{'font': []}],
    [{'align': []}],

    ['clean'], // remove formatting button

];
var editor = [];
for (let i = 1; i <= count; i++) {
    let temp = '#reply' + i;
    editor[i] = new Quill(temp, {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    editor[i].setContents([
        {
            insert: 'Hello,\n', attributes: {bold: true, align: "center", color: "#232530", header: "2"}
        },
        {
            insert: '\nThanks for Applying for a job,\n' +
                'we received your application, and we are pleased to tell you that you are accepted to be interviewed in La Terra Santa Hotel.\n' +
                'We are waiting for you tomorrow on 9:00 AM.\n' +
                'La Terra Santa.' +
                '\n\n Best of luck.' + '  \n',
            attributes: {bold: true, align: "center", color: "#B79040", header: "3"}
        }
    ]);
}

