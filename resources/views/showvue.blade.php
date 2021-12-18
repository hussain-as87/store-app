<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <title>vue show</title>
</head>
<body>
<div id="app">
    <h1>@{{ message }}</h1>
    <h2 v-if="false">@{{ message }}</h2>
    <input type="text" name="message" v-model="name" id="">
    <button type="submit" v-on:click="add">add</button>

    <ul>
        <li v-for="name in names">
            @{{ name.id }}
            /@{{ name.name }}
            <button type="submit" v-on:click="remove(n)">remove</button>
        </li>
    </ul>
</div>
<script>
    var app = new Vue({
        el: '#app'
        , data: {
            name: ''
            , message: 'Hello Vue!'
            , names: []
        }
        , methods: {
            add: function () {
                this.names.push({
                    id: 3
                    , name: this.name
                });
                alert(this.name)
            }
            , remove: function (n) {
                index = this.names.indexOf(n);
                this.names.splice(index, 1);
            }
        }
        , mounted: function () {
            fetch('http://127.0.0.1:8000/api/product')

                .then(res => res.json())
                .then(data => {
                    this.names = push(data)
                });

            /* this.names: [{
                    id: 1
                    , name: 'khalid'
                }
                , {
                    id: 2
                    , name: 'mohamed'
                }
            ] */

        }

    })

</script>
</body>
</html>
