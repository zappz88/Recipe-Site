<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous"/>
        <link rel="stylesheet" href="foodbug.css">
        <title>Food Bug</title>
    </head>
    <body>

        <div id="main" class="container text-center my-1">

            <div id="inputs" class="row justify-content-center text-center">
                <div class="form-inline justify-content-center my-sm-2">
                    <div class="form-group mx-sm-2">
                        <input type="text" id='userName' class='p-sm-1' placeholder='username' name='userName' required>
                    </div>
                    <div class="form-group mx-sm-2">
                        <input type="password" id='userPassword' class='p-sm-1' placeholder='password' name='userPassword' required>
                    </div>
                </div>
                <div class="form-inline justify-content-center my-sm-2">
                    <div class="form-group mx-sm-3">
                        <input type="checkbox" id="rememberUser" name="rememberUser" value="false">
                        <p class="m-auto">Save Login</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center text-center my-sm-1">
                <div class="form-inline justify-content-center">
                    <div class="form-group mx-2">
                        <button type="button" id="loginBtn" class="btn btn-primary">Login</button>
                    </div>
                    <div class="form-group mx-2">
                        <button type="button" id="registerBtn" class="btn btn-primary"><a href="http://localhost/FoodBug/registrationPage.php" class="text-decoration-none text-white">Register</a></button>
                    </div>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Menu</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item active" href="index.php">Home</a>
                            <a class="dropdown-item" href="accountPage.php">Account</a>
                            <a class="dropdown-item" href="#">Bookmarks</a>
                            <a class="dropdown-item" href="#">About Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="status" class="mx-auto text-center"></div>

            <div>
                <h1 class="display-1">Food<small>Bug</small></h1>
                <p><i>Catch the Food Bug</i></p>
            </div>

            <div class="form-group">
                <label for="searchBar">Search Recipes</label>
                <input type="search" class="form-control w-50 mx-auto" id="searchBar">
            </div>
            <div class="form-group">
                <button type="button" id="searchBtn" class="btn btn-primary">Find</button>        
            </div>
        </div>

        <div id="recipes" class="container">

        </div>



        <script>
            class LocalStore {
                constructor() {
                    this.collection = window.localStorage;
                }

                collection() {
                    return this.collection;
                }

                log() {
                    return console.log(this.collection);
                }

                set(key, value) {
                    return this.collection.setItem(key, JSON.stringify(value));
                }

                get(key) {
                    return JSON.parse(this.collection.getItem(key));
                }

                remove(key) {
                    return this.collection.removeItem(key);
                }

                clear() {
                    return this.collection.clear();
                }

                isEmpty() {
                    return this.collection.length === 0;
                }
            }



            class SessionStore {
                constructor() {
                    this.collection = window.sessionStorage;
                }

                collection() {
                    return this.collection;
                }

                log() {
                    return console.log(this.collection);
                }

                set(key, value) {
                    return this.collection.setItem(key, JSON.stringify(value));
                }

                get(key) {
                    return JSON.parse(this.collection.getItem(key));
                }

                remove(key) {
                    return this.collection.removeItem(key);
                }

                clear() {
                    return this.collection.clear();
                }

                isEmpty() {
                    return this.collection.length === 0;
                }
            }

            class Collection {
                constructor() {
                    this.collection = [];
                }

                collection() {
                    return this.collection;
                }

                log() {
                    return console.log(this.collection);
                }

                push(value) {
                    return this.collection.push(value);
                }

                pushAll(...values) {
                    return this.collection.push(...values);
                }

                pop() {
                    return this.collection.pop();
                }

                shift() {
                    return this.collection.shift();
                }

                unshift(value) {
                    return this.collection.unshift(value);
                }

                unshiftAll(...values) {
                    return this.collection.unshift(...values);
                }

                remove(index) {
                    return this.collection.splice(index, 1);
                }

                add(index, value) {
                    return this.collection.splice(index, 0, value);
                }

                replace(index, value) {
                    return this.collection.splice(index, 1, value);
                }

                clear() {
                    this.collection.length = 0;
                }

                isEmpty() {
                    return this.collection.length === 0;
                }

                viewFirst() {
                    return this.collection[0];
                }

                viewLast() {
                    return this.collection[this.collection.length - 1];
                }
            }

////////////////////////////////////////////////////////////////////////////////

            const apiKey = '&app_key=95ad2969f96251d1c447e97b4f3aa1c9';
            const appId = '&app_id=80cffcc7';
            const apiEndPoint = 'https://api.edamam.com/search?q=';
            const proxy = 'https://cors-anywhere.herokuapp.com/';
            const url = `${proxy}${apiEndPoint}`;

            let local = new LocalStore();
            let session = new SessionStore();
            let bookmarks = new Collection();

////////////////////////////////////////////////////////////////////////////////

            $(window).bind('load', function () {
                if (session.get('status') === 'true' || local.get('status') === 'true') {

                    if (session.get('userName') !== null || local.get('userName') !== null) {
                        if (local.get('userName') !== null) {
                            $('#userName').val(local.get('userName'));
                        } else {
                            $('#userName').val(session.get('userName'));
                        }
                    }

                    if (session.get('userPassword') !== null || local.get('userPassword') !== null) {
                        if (local.get('userPassword') !== null) {
                            $('#userPassword').val(local.get('userPassword'));
                        } else {
                            $('#userPassword').val(session.get('userPassword'));
                        }
                    }

                    if (($('#userName').val() !== '') && $('userPassword').val() !== '') {
                        $('#loginBtn').click();
                    }
                }
            });

////////////////////////////////////////////////////////////////////////////////

            $(document).ready(function () {

                function login(obj, url) {
                    if (session.isEmpty() === true) {
                        $.ajax({
                            method: 'POST',
                            url: url,
                            data: obj,
                            success: function (data) {
                                if (typeof JSON.parse(data) === 'object') {
                                    let response = JSON.parse(data);
                                    if ($('#rememberUser').val() === 'true') {
                                        local.set('userName', response.userName);
                                        local.set('userPassword', response.userPassword);
                                        local.set('status', response.status);
                                    }
                                    session.set('status', response.status);
                                    session.set('userName', response.userName);
                                    session.set('userPassword', response.userPassword);
                                    $('#status').text(response.message).fadeTo(1000, 1).fadeTo(1000, 0);
                                    $('#inputs').fadeTo(1000, 0).slideUp('250');
                                    $('#registerBtn').fadeOut(1000);
                                    $('#loginBtn').text('Logout');
                                } else {
                                    $('#status').text(JSON.parse(data)).fadeTo(1000, 1).fadeTo(1000, 0);
                                }
                            },
                            error: function (textStatus) {
                                $('#status').text(textStatus);
                            }
                        });
                    } else {
                        session.clear();
                        $('#status').text('Logged Out').fadeTo(1000, 1).fadeTo(1000, 0);
                        $('#inputs').slideDown('250').fadeTo(1000, 1);
                        $('#loginBtn').text('Login');
                        $('#registerBtn').fadeIn(2000);
                    }
                }

                function search() {
                    let html = $('#searchBtn').html();
                    $('#searchBtn').html('<span></span>');
                    $('span').addClass('spinner-border spinner-border-sm');
                    $('#recipes').html('');
                    let query = $('#searchBar').val();
                    $.ajax({
                        method: "GET",
                        url: `${url}${query}${appId}${apiKey}`,
                        success: function (data) {
                            $('span').removeClass('spinner-border spinner-border-sm');
                            $('#searchBtn').html(html);
                            let recipes = data.hits;
                            for (let i = 0; i < recipes.length; i++) {
                                document.getElementById('recipes').innerHTML += `<div class='col-sm-8 m-sm-3 p-sm-5 shadow-lg text-center justify-content-center'><h1>${recipes[i].recipe.label}</h1>
                                <img src='${recipes[i].recipe.image}'><br><button type='button' id='recipeBtn${i}' class='btn btn-primary m-sm-2'><a href="${recipes[i].recipe.url}" class='text-white text-decoration-none'>Recipe</a></button>
                                <button type='button' id='bookmarkBtn${i}' class='btn btn-primary'>Bookmark</button><div class='row justify-content-around ml-sm-3'><div class='col-sm-5 text-left justify-content-center'>
                                <h4>Ingredients</h4><ul>${recipes[i].recipe.ingredientLines.map((currentVal) => '<li>' + currentVal + '</li>').join("")}</ul></div>
                                <div class='col-sm-5 text-left'><h4>Health Information</h4><ul>${recipes[i].recipe.healthLabels.map((currentVal) => '<li>' + currentVal + '</li>').join("")}</ul></div></div></div>`;
                            }
                        },
                        error: function (errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                }



////////////////////////////////////////////////////////////////////////////////

                $("#searchBtn").click(function () {
                    if ($("#searchBar").val() !== '') {
                        search();
                    }
                });

                $("#searchBar").keydown(function (event) {
                    if (event.keyCode === 13 && $(this).val() !== '') {
                        $("#searchBtn").click();
                    }
                });

                $('#loginBtn').bind('click', function () {
                    let user = {
                        userName: $('#userName').val(),
                        userPassword: $('#userPassword').val()
                    };
                    login(user, 'login.php');
                });

                $('#rememberUser').bind('click', function () {
                    $('#rememberUser').val() === ('false' || false) ? $('#rememberUser').val('true') : $('#rememberUser').val('false');
                });

            });
        </script>
    </body>
</html>
