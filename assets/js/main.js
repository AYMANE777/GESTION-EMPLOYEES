jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            return (
                key == 8 || 
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};
let notifs = []
function getNotifactions()
{
    $.ajax({
        url: "../includes/ajax/getNotifications.php",
        method: "POST",
        dataType:"JSON",
        success:function(response){
            if(response.data != 0)
            {
                for(var i = 0; i < response.length; i++)
                {
                    if(!notifs.includes(response[i].id))
                    {
                        notifs.push(response[i].id)
                        $("#notifs").append('<div class="d-flex flex-stack py-4"><div class="d-flex align-items-center"><div class="me-4 symbol symbol-35px"><span class="bg-light-danger symbol-label"><span class="svg-icon svg-icon-2 svg-icon-danger"><svg fill="none"height="24"viewBox="0 0 24 24"width="24"xmlns="http://www.w3.org/2000/svg"><rect fill="black"height="20"rx="10"width="20"x="2"y="2"opacity="0.3"/><rect fill="black"height="2"rx="1"width="7"x="11"y="14"transform="rotate(-90 11 14)"/><rect fill="black"height="2"rx="1"width="2"x="11"y="17"transform="rotate(-90 11 17)"/></svg></span></span></div><div class="mb-0 me-2"><a class="fs-6 fw-bolder text-gray-800 text-hover-primary"href="#">'+response[i].title+'</a><div class="fs-7 text-gray-400">'+response[i].sender+' '+response[i].action+'</div></div></div><span class="badge badge-light fs-8">'+response[i].date+'</span></div>') 
                    }
                }
            }
        }
    })
}
function notifCounter()
{
    $.ajax({
        url: "../includes/ajax/totlaNotifs.php",
        method: "POST",
        dataType:"JSON",
        success:function(response){
            if(response.data > 0)
            {
                $("#bdageNotif").html('<span class="position-absolute top-0 start-0 translate-middle  badge badge-circle badge-danger">'+response.data+'</span>')
            }else{
                $("#bdageNotif").html("")
            }
        }
    })
}
function changeNotifStatus(notifID)
{
    $.ajax({
        url: "../includes/ajax/changeNotifStatus.php",
        method: "POST",
        dataType: "JSON"
    })
}

jQuery.fn.aae =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            return (
                key == 0);
        });
    });
}


function setInputsErrors(element)
{
    let userText = "";
    if(element == "username")
    {
        userText = "Matricule ou CIN"
    }else if(element == "password"){
        userText = "Mot de passe"
    }else if(element == "type")
    {
        userText = "Type";
    }else if(element == "newpass")
    {
        userText = "Nouveau mot de passe";
    }else if(element == "cnewpass")
    {
        userText = "Confirmation de le mot de passe ";
    }else if(element == "claim-title")
    {
        userText = "Titre"
    }else if(element == "claim-content")
    {
        userText = "Les détails"
    }

    if($("#"+element+"").val() == null || $("#"+element+"").val() == "")
    {
        $("#"+element+"").addClass("is-invalid")
        $("#"+element+"").removeClass("is-valid")
        $("#"+element+"-verification").text(""+userText+" est obligatoire.")
    }else{
        $("#"+element+"").removeClass("is-invalid")
        $("#"+element+"").addClass("is-valid")
        $("#"+element+"-verification").text("")
    }
}

function deleteReclamationReply(reply_id)
{
    if(reply_id != "")
    {
        $.ajax({
            url: "../includes/ajax/deleteReply.php",
            method: "POST",
            data: {reply_id:reply_id},
            dataType: "JSON",
            cahse: false,
            success:function(response)
            {
                Swal.fire({
                    icon: response.status,
                    text: response.message
                })

                setTimeout(()=>{
                    if(response.status == "success")
                    {
                        location.reload();
                    }
                }, 1000)
            }
        })
    }
}


$("#username").on("blur keyup keydown", ()=>{
    setInputsErrors("username")
});

$("#password").on("blur keyup keydown", ()=>{
    setInputsErrors("password")
});

$("#type").change(()=>{
    setInputsErrors("type")
})

$("#newpass").on("blur keyup keydown", ()=>{
    setInputsErrors("newpass")
});

$("#cnewpass").on("blur keyup keydown", ()=>{
    setInputsErrors("cnewpass")
});

$("#claim-title").on("blur keyup keydown", ()=>{
    setInputsErrors("claim-title")
});

$("#claim-content").on("blur keyup keydown", ()=>{
    setInputsErrors("claim-content")
});


$("#doLogin").click(()=>{
    let username = $("#username").val()
    let password = $("#password").val()
    let type = $('input[type=radio]:checked').val();
    
    if(username == "")
    {
        setInputsErrors("username")
    }

    if(password == "")
    {
        setInputsErrors("password")
    }

    if($('input[type=radio]:checked').length <= 0)
    {
        type = null
        setInputsErrors("type")
    }

    if(username != "" && password != "" && type != null)
    {
        $("#doLogin").attr("disabled", "true")
        $(".indicator-label").hide();
        $(".indicator-progress").show();
        $("#loader-icon").show();
        $.ajax({
            url: "includes/ajax/sign-in.php",
            method: "POST",
            data: {username:username, password:password, type:type},
            dataType: "JSON",
            cashe: false,
            success:function(response){
                setTimeout(()=>{
                    $("#loader-icon").hide();
                    $(".indicator-progress").hide();
                    $(".indicator-label").show();
                    $("#doLogin").removeAttr("disabled")
                    if(response.status == "success")
                    {
                        Swal.fire({
                            icon: "success",
                            text: response.message
                        })
                        $("#username").removeClass("is-invalid")
                        $("#username").addClass("is-valid")
                        $("#password").removeClass("is-invalid")
                        $("#password").addClass("is-valid")
                        $("#type").removeClass("is-invalid")
                        $("#type").addClass("is-valid")
                        setTimeout(()=>{
                            if(type == 1)
                            {
                                location.replace("espace-formateur/dashboard")
                            }else if(type == 2)
                            {
                                location.replace("espace-stagiaire/dashboard")
                            }else if(type == 3)
                            {
                                location.replace("espace-directeur/dashboard")
                            }else if(type == 4)
                            {
                                location.replace("espace-conseilleur/dashboard")
                            }

                        }, 1000)
                    }else{
                        Swal.fire({
                            icon: "error",
                            text: response.message
                        })

                        $("#username").addClass("is-invalid")
                        $("#username").removeClass("is-valid")
                        $("#password").addClass("is-invalid")
                        $("#password").removeClass("is-valid")
                        $("#type").addClass("is-invalid")
                        $("#type").removeClass("is-valid")
                    }
                }, 1500);
            }
        })
        
    }
})

$("#doUpdatePassword").click(()=>{
    let newpass = $("#newpass").val()
    let cnewpass = $("#cnewpass").val()
    if(newpass == "" || cnewpass == "")
    {
        Swal.fire({
            icon: "error",
            text: "Tout les champs est obligatoire!"
        })
    }else{
        if(newpass != cnewpass)
        {
            Swal.fire({
                icon: "error",
                text: "Votre mot de passe n'est pas bien confirmé!"
            })
        }else{
            $.ajax({
                method: "POST",
                url: "../includes/ajax/update-password.php",
                cahse: false,
                data: {newpass:newpass, cnewpass:cnewpass},
                dataType: "JSON",
                success:function(response)
                {
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                }
            })
        }
    }
    
})

var DataTableEngagements = function() {
    var t, e;
    return {
        init: function() {
            (t = document.querySelector("#kt_engagements_table")) && (t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[0].innerHTML, "MMM DD, YYYY").format();
                e[0].setAttribute("data-order", r)
            })), e = $(t).DataTable({
                info: !1,
                order: [],
                pageLength: 10
            }), (() => {
                var t = moment().subtract(29, "days"),
                    e = moment(),
                    r = $("#kt_engagements_daterangepicker");

                function o(t, e) {
                    r.html(t.format("MMMM D, YYYY") + " - " + e.format("MMMM D, YYYY"))
                }
                r.daterangepicker({
                    startDate: t,
                    endDate: e,
                    ranges: {
                        "Aujourd'hui": [moment(), moment()],
                        Hier: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                        "Les derniers 7 jours": [moment().subtract(6, "days"), moment()],
                        "Les derniers 30 jours": [moment().subtract(29, "days"), moment()],
                        "Ce mois-ci": [moment().startOf("month"), moment().endOf("month")],
                        "Le mois dernier": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                    }
                }, o), o(t, e)
            })(), (() => {
                const e = "Rapport des Engagements";
                new $.fn.dataTable.Buttons(t, {
                    buttons: [{
                        extend: "copyHtml5",
                        title: e
                    }, {
                        extend: "excelHtml5",
                        title: e
                    }, {
                        extend: "csvHtml5",
                        title: e
                    }, {
                        extend: "pdfHtml5",
                        title: e
                    }]
                }).container().appendTo($("#kt_engagements_export")), document.querySelectorAll("#kt_engagements_export_menu [data-kt-engagement-export]").forEach((t => {
                    t.addEventListener("click", (t => {
                        t.preventDefault();
                        const e = t.target.getAttribute("data-kt-engagement-export");
                        document.querySelector(".dt-buttons .buttons-" + e).click()
                    }))
                }))
            })(), document.querySelector('[data-kt-engagement-order-filter="search"]').addEventListener("keyup", (function(t) {
                e.search(t.target.value).draw()
            })), (() => {
                const t = document.querySelector('[data-kt-engagement-order-filter="status"]');
                $(t).on("change", (t => {
                    let r = t.target.value;
                    "all" === r && (r = ""), e.column(3).search(r).draw()
                }))
            })())
        }
    }
}();

function removeEngagement(engID)
{
    if(engID == "" || engID == null)
    {
        Swal.fire({
            icon: "error",
            text: "Invalide engagement id!"
        })
    }else{
        $.ajax({
            url: "../includes/ajax/remove-engagement.php",
            method: "POST",
            data: {engID:engID},
            dataType: "JSON",
            cahse: false,
            success:function(response)
            {
                Swal.fire({
                    icon: response.status,
                    text: response.message
                })

                if(response.status == "success")
                {
                    location.replace("gestion-engagements")
                }
            }
        })
    }
}

$("#add-matricule").on("change", ()=>{
    let mat = $("#add-matricule").val()
    if(mat != "")
    {
        $.ajax({
            url: "../includes/ajax/check-matricule.php",
            method: "POST",
            data: {mat:mat},
            dataType: "JSON",
            success:function (response) {
                $("#checking-matricule-spinner").show()
                setTimeout(()=>{
                    $("#checking-matricule-spinner").hide()
                    if(response)
                    {
                        $("#add-matricule").removeClass("is-invalid")
                        $("#add-matricule").addClass("is-valid")
                        $("#add-matricule-verification").text("")
                    }else{
                        $("#add-matricule").addClass("is-invalid")
                        $("#add-matricule").removeClass("is-valid")
                        $("#add-matricule-verification").text("Ce matricule est invalide .")
                    }
                }, 1000)
                
            }
        })
    }
});



$("#markAsRead").click(()=>{
    let checkBoxes = document.querySelectorAll('input[data-checkbox="message-inbox"]');
    checkBoxes.forEach(element => {
        if(element.checked)
        {
            let messageID = element.value
            $.ajax({
                url:"../includes/ajax/markAsRead.php",
                method:"POST",
                cashe:false,
                data:{messageID:messageID},
                dataType:"JSON",
                success:function(response){
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        location.replace($("#pageName").val())
                    }, 850)
                }
            })
        }
    });
})

$("#reloadMessages").click(()=>{
    Swal.showLoading()
    setTimeout(()=>{
        location.replace($("#pageName").val())
    }, 500)
})

$("#deleteMessages").click(()=>{
    console.log("test")
    let checkBoxes = document.querySelectorAll('input[data-checkbox="message-inbox"]');
    checkBoxes.forEach(element => {
        if(element.checked)
        {
            let messageID = element.value
            console.log(messageID)
            $.ajax({
                url:"../includes/ajax/deleteMessage.php",
                method:"POST",
                cashe:false,
                data:{messageID:messageID},
                dataType:"JSON",
                success:function(response){
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        location.replace($("#pageName").val())
                    }, 850)
                }
            })
        }
    });
})

var getStagiaireFormateur = function() {
    
    const e = e => {
            const t = e.querySelector('[data-kt-inbox-form="cc"]');
        },
        t = e => {
            const t = ""
        },
        a = e => {
            if($("#newMessage").val() == "stagiaire-message")
            {
                $.ajax({
                    url: "../includes/ajax/getStagiaireFormateur.php",
                    method: "POST",
                    dataType: "JSON",
                    success:function(response)
                    {
                        var t, a = new Tagify(e, {
                            tagTextProp: "name",
                            enforceWhitelist: !0,
                            skipInvalid: !0,
                            dropdown: {
                                closeOnSelect: !1,
                                enabled: 0,
                                classname: "users-list",
                                searchKeys: ["name", "email"]
                            },
                            templates: {
                                tag: function(e) {
                                    return `\n                <tag title="${e.title||e.email}"\n                        contenteditable='false'\n                        spellcheck='false'\n                        tabIndex="-1"\n                        class="${this.settings.classNames.tag} ${e.class?e.class:""}"\n                        ${this.getAttributes(e)}>\n                    <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>\n                    <div class="d-flex align-items-center">\n                        <div class='tagify__tag__avatar-wrap ps-0'>\n                            <input type="hidden" id="formateurMat" value="${e.value}">\n                        </div>\n                        <span class='tagify__tag-text'>${e.name}</span>\n                    </div>\n                </tag>\n            `
                                },
                                dropdownItem: function(e) {
                                    return `\n                <div ${this.getAttributes(e)}\n                    class='tagify__dropdown__item d-flex align-items-center ${e.class?e.class:""}'\n                    tabindex="0"\n                    role="option">\n\n                    ${e.avatar?`\n                            <div class='tagify__dropdown__item__avatar-wrap me-2'>\n                                <formateur-matricule id="formateurMat" value="${e.value}">\n                            </div>`:""}\n\n                    <div class="d-flex flex-column">\n                        <strong>${e.name}</strong>\n                        <span>${e.email}</span>\n                    </div>\n                </div>\n            `
                                }
                            },
                            
                            whitelist: [{
                                value: response.matricule,
                                name: response.prenom + " " + response.nom,
                                avatar: "",
                                email: response.module
                            },
                        ]
                        });
                    }
                    
                })
            }else{
                $.ajax({
                    url: "../includes/ajax/getFormateurStagiaires.php",
                    method: "POST",
                    dataType: "JSON",
                    success:function(response)
                    {
                        var dict = [];
                        for(var i = 0; i < response.length; i++)
                        {
                            dict.push(response[i])
                        }
                        var t, a = new Tagify(e, {
                            maxTags: 1,
                            tagTextProp: "name",
                            enforceWhitelist: !0,
                            skipInvalid: !0,
                            dropdown: {
                                closeOnSelect: !1,
                                enabled: 0,
                                classname: "users-list",
                                searchKeys: ["name", "email"]
                            },
                            templates: {
                                tag: function(e) {
                                    return `\n                <tag title="${e.title||e.email}"\n                        contenteditable='false'\n                        spellcheck='false'\n                        tabIndex="-1"\n                        class="${this.settings.classNames.tag} ${e.class?e.class:""}"\n                        ${this.getAttributes(e)}>\n                    <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>\n                    <div class="d-flex align-items-center">\n                        <div class='tagify__tag__avatar-wrap ps-0'>\n                            <input type="hidden" id="stagiaireMat" value="${e.value}">\n                        </div>\n                        <span class='tagify__tag-text'>${e.name}</span>\n                    </div>\n                </tag>\n            `
                                },
                                dropdownItem: function(e) {
                                    return `\n                <div ${this.getAttributes(e)}\n                    class='tagify__dropdown__item d-flex align-items-center ${e.class?e.class:""}'\n                    tabindex="0"\n                    role="option">\n\n                    ${e.avatar?`\n                            <div class='tagify__dropdown__item__avatar-wrap me-2'>\n                                <formateur-matricule id="stagiaireMat" value="${e.value}">\n                            </div>`:""}\n\n                    <div class="d-flex flex-column">\n                        <strong>${e.name}</strong>\n                        <span>${e.value}</span>\n                    </div>\n                </div>\n            `
                                }
                            },
                            
                            whitelist: dict
                        });
                    }
                    
                })
            }
        },
        n = e => {
            new Quill("#kt_inbox_form_editor", {
                
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, !1]
                        }],
                        ["bold", "italic", "underline"],
                        ["image", "code-block"]
                    ]
                },
                placeholder: "Écrivez votre texte ici...",
                theme: "snow"
            });
            const t = e.querySelector(".ql-toolbar");
            if (t) {
                const e = ["px-5", "border-top-0", "border-start-0", "border-end-0"];
                t.classList.add(...e)
            }
        }
        
    return {
        init: function() {
            (() => {
                const r = document.querySelector("#kt_inbox_compose_form"),
                    l = r.querySelectorAll('[data-kt-inbox-form="tagify"]');
                e(r), t(r), l.forEach((e => {
                    a(e)
                })), n(r)
            })()
        }
    }
}();

$("#sendMessage").click(()=>{
    let receiverid;
    if($("#formateurMat").val() != "" && $("#formateurMat").val() != null)
    {
        receiverid = $("#formateurMat").val()
    }else{
        receiverid = $("#stagiaireMat").val()
    }
    let subject = $("#subject").val()
    let message = $(".ql-editor").html()

    if(receiverid == "" || subject == "" || message == "")
    {
        Swal.fire({
            icon: "warning",
            text: "Tout les champs est obligatoire!"
        })
    }else{
        $("#span-send").hide()
        $("#span-progress").show()
        $("#span-send-spinner").show()
        $.ajax({
            url: "../includes/ajax/sendMessage.php",
            method: "POST",
            dataType: "JSON",
            data: {receiverid:receiverid, subject:subject, message:message},
            success:function(response){
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    $("#span-send").show()
                    $("#span-progress").hide()
                    $("#span-send-spinner").hide()
                }, 1200)
            }
        })
    }
   
})

$("#sendReply").click(()=>{
    let reply = $("#reply-message").val()
    if(reply == "")
    {
        Swal.fire({
            icon: "warning",
            text: "Le message ne doit pas être vide!"
        })
    }else{
        $("#span-reply").hide()
        $("#span-progress-reply").show()
        $("#span-reply-spinner").show()
        $.ajax({
            url: "../includes/ajax/sendReply.php",
            method: "POST",
            data:{reply:reply},
            dataType: "JSON",
            success:function(response){
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    $("#span-reply").show()
                    $("#span-progress-reply").hide()
                    $("#span-reply-spinner").hide()
                    setTimeout(()=>{
                        document.location.reload(true)
                    }, 700)
                }, 1200)
            }
        })
    }
})

$("#sendClaim").click(()=>{
    let title = $("#claim-title").val()
    let content = $("#claim-content").val()
    let type = $("#type").val()

    if(title == "" || content == "" || type == "")
    {
        Swal.fire({
            icon: "warning",
            text: "Tout les champs sont obligatoire!"
        })
    }else{
        $("#label-claim").hide()
        $("#progress-claim").show()
        $("#spinner-claim").show()

        $.ajax({
            url: "../includes/ajax/addProblem.php",
            method: "POST",
            data: {title:title, content:content, type:type},
            dataType: "JSON",
            success:function(response){
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    $("#label-claim").show()
                    $("#progress-claim").hide()
                    $("#spinner-claim").hide()
                    setTimeout(()=>{
                        document.location.reload(true)
                    }, 900)
                }, 1200)
            }
        })
    }
})

$("#sendProblemReply").click(()=>{
    let reply = $("#problem-reply").val()
   
    if(reply == "")
    {
        Swal.fire({
            icon: "warning",
            text: "Le commentaire est obligatoire!"
        })
    }else{
        $.ajax({
            url: "../includes/ajax/sendProblemReply.php",
            method: "POST",
            data: {reply:reply},
            dataType: "JSON",
            success:function(response)
            {
                $("#spinner-problem-reply").show()
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    $("#spinner-problem-reply").hide()
                    setTimeout(()=>{
                        document.location.reload(true)
                    }, 900)
                }, 1200) 
            }
        })
    }
})

$("#deleteProblem").click(()=>{
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
        confirmButtonText: 'Oui, supprimez-le !'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url: "../includes/ajax/deleteProblem.php",
              method: "POST",
              dataType: "JSON",
              success:function(response)
              {
                Swal.fire({
                    icon: response.status,
                    text: response.message
                })
                setTimeout(()=>{
                    if(response.status == "success")
                    {
                        document.location.reload(true)
                    }
                }, 1000)
                
              }
          })
        }
    })
})

$("#addEntretien").click(()=>{
    let subject = $("#subject").val()
    let description = $("#description").val()
    let type = $("#type").val()
    let tool = $("#tool").val()
    let date = $("#date").val()
    let startTime = $("#startTime").val()
    let endTime = $("#endTime").val()
    let stagiaire = $("#stagiaire").val()

    if(subject == "" || description == "" || type == "" || tool == "" || date == "" || startTime == "" || endTime == "" || stagiaire == "")
    {
        Swal.fire({
            icon: "warning",
            text: "Tout les champs sont obligatoire!",
            title: "Attention"
        })
    }else{
        $.ajax({
            url: "../includes/ajax/addEntretien.php",
            method: "POST",
            dataType: "JSON",
            data: {subject:subject, description:description, type:type, tool:tool, type:type, date:date, startTime:startTime, endTime:endTime, stagiaire:stagiaire},
            success:function(response)
            {
                Swal.showLoading()
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        location.reload()
                    }, 900)
                }, 1000)
            }
        })
    }
})


$("#focusReply").click(()=>{
    $("#reply-message").focus();
    $('html,body').animate({
        scrollTop: $("#reply-message").offset().top},
        'slow');
})

function showStagiaireDetails(matricule)
{
    if(matricule != "")
    {
        $("#loader").fadeIn()
        $("#kt_stagiaire_main").hide()
        setTimeout(()=> {
            
            $.ajax({
                url: "../includes/ajax/getStagiaireDetails.php",
                method: "POST",
                dataType: "JSON",
                data: {matricule:matricule},
                success:function(response)
                {
                    $("#loader").hide()
                    $("#kt_stagiaire_main").fadeIn()
                    $("#stagiaire-fullname").text(response.prenom + " " + response.nom)
                    $("#stagiaire-matricule").text(response.matricule)
                    $("#stagiaire-filiere").text(response.filiere)
                    $("#stagiaire-niveau").text(response.niveau)
                    $("#stagiaire-année").text(response.formation_year)
                }
            })
        }, 800)
    }
}

function removeProblem(problemID)
{
    if(problemID != "")
    {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Annuler',
            confirmButtonText: 'Oui, supprimez-le !'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: "../includes/ajax/deleteProblem.php",
                  method: "POST",
                  dataType: "JSON",
                  data: {problemID:problemID},
                  success:function(response)
                  {
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        if(response.status == "success")
                        {
                            location.reload()
                        }
                    }, 1000)
                    
                  }
              })
            }
        })
    }
}

function removeEntretien(entretienID)
{
    if(entretienID != "")
    {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Annuler',
            confirmButtonText: 'Oui, supprimez-le !'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: "../includes/ajax/deleteEntretien.php",
                  method: "POST",
                  dataType: "JSON",
                  data: {entretienID:entretienID},
                  success:function(response)
                  {
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        if(response.status == "success")
                        {
                            location.reload()
                        }
                    }, 1000)
                    
                  }
              })
            }
        })
    }
}

function removeActivity(activityID)
{
    if(activityID != "")
    {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Annuler',
            confirmButtonText: 'Oui, supprimez-le !'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: "../includes/ajax/deleteActivity.php",
                  method: "POST",
                  dataType: "JSON",
                  data: {activityID:activityID},
                  success:function(response)
                  {
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        if(response.status == "success")
                        {
                            location.reload()
                        }
                    }, 1000)
                    
                  }
              })
            }
        })
    }
}

function changeReclamationStatus(statusNum)
{
    let status = "";
    if(statusNum == 1)
    {
        status = "Résolu"
    }else if(statusNum == 2)
    {
        status = "Annulé"
    }

    $.ajax({
        url: "../includes/ajax/changeReclamationStatus.php",
        method: "POST",
        data: {status:status},
        dataType: "JSON",
        success:function(response)
        {
            Swal.showLoading()
            setTimeout(()=>{
                Swal.fire({
                    icon: response.status,
                    text: response.message
                })
                setTimeout(()=>{
                    document.location.reload(true)
                }, 900)
            }, 1200) 
        }
    })
}

function resoluReclamation(reclamationID)
{
    $.ajax({
        url: "../includes/ajax/resoluReclamation.php",
        method: "POST",
        data: {reclamationID:reclamationID},
        dataType: "JSON",
        success:function(response)
        {
            Swal.showLoading()
            setTimeout(()=>{
                Swal.fire({
                    icon: response.status,
                    text: response.message
                })
                setTimeout(()=>{
                    document.location.reload(true)
                }, 900)
            }, 1200) 
        }
    })
}

function annuleReclamation(reclamationID)
{
    $.ajax({
        url: "../includes/ajax/annuleReclamation.php",
        method: "POST",
        data: {reclamationID:reclamationID},
        dataType: "JSON",
        success:function(response)
        {
            Swal.showLoading()
            setTimeout(()=>{
                Swal.fire({
                    icon: response.status,
                    text: response.message
                })
                setTimeout(()=>{
                    document.location.reload(true)
                }, 900)
            }, 1200) 
        }
    })
}

function removeStagiaireCAD(stID)
{
    if(stID != "")
    {
        $.ajax({
            url: "../includes/ajax/removeStagiaireCAD.php",
            method: "POST",
            data: {stID:stID},
            dataType: "JSON",
            success:function(response)
            {
                Swal.showLoading()
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        document.location.reload(true)
                    }, 900)
                }, 1200) 
            }
        })
    }

}

$("#addStagiaireCAD").click(()=>{
    let stagiaire = $("#stagiaire").val()
    let fonction = $("#fonction").val()
    if(stagiaire != "" && fonction != "")
    {
        $.ajax({
            url: "../includes/ajax/addStagiaireCAD.php",
            method: "POST",
            data: {stagiaire:stagiaire, fonction:fonction},
            dataType: "JSON",
            success:function(response)
            {
                Swal.showLoading()
                setTimeout(()=>{
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        document.location.reload(true)
                    }, 900)
                }, 1200) 
            }
        })
    }else{
        Swal.fire({
            icon: "warning",
            title: "Attention!",
            text: "Tout les champs sont obligatoire!"
        })
    }
})

$("#addTuto").click(()=>{
    let title = $("#tuto-title").val()
    let link = $("#tuto-link").val()
    let description = $("#tuto-description").val()

    if(title == "" || link == "" || description == "")
    {
        Swal.fire({
            "icon": "warning",
            "text": "Tout les champs sont obligatoire!",
            "title": "Attention"
        })
    }else{
        $("#label-ajotuer").hide()
        $("#progress-tuto").show()
        $("#spinner-tuto").show()
        $.ajax({
            url: "../includes/ajax/addTutorial.php",
            method: "POST",
            data: {title:title, link:link, description:description},
            dataType: "JSON",
            success:function(response)
            {
                Swal.showLoading()
                setTimeout(()=>{
                    $("#label-ajotuer").show()
                    $("#progress-tuto").hide()
                    $("#spinner-tuto").hide()
                    Swal.fire({
                        icon: response.status,
                        text: response.message
                    })
                    setTimeout(()=>{
                        document.location.reload(true)
                    }, 900)
                }, 1200) 
            }
        })
    }
})
setInterval(()=>{
    getNotifactions()
    notifCounter()
}, 1000)
//$("#kt_stagiaire_main").hide()
KTUtil.onDOMContentLoaded((function() {
    
    //location.replace($("#pageName").val())
    getStagiaireFormateur.init()
    DataTableEngagements.init()
    $("#checking-matricule-spinner").hide()
    $(".ql-image").hide()
    $(".ql-code-block").hide()
    
}));