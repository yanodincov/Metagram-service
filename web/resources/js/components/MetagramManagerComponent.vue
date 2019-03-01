<template>
    <div>
        <div class="alert" v-bind:class="{ 'alert-success' : type === 'success', 'alert-danger' : type === 'error', 'alert-info' : type === 'info' }" v-if="messages.length > 0">
            <div v-if="type === 'success'">
                <p class="mb-0">
                    Слово "{{ messages[0] }}" превращается в слово "{{ messages[ messages.length - 1 ] }}"
                </p>
                <p class="m-1">
                    Количество итераций: <strong>{{ messages.length }}</strong>
                </p>
            </div>
            <ol class="m-0">
                <li class="mb-0" v-for="msg in messages" v-html="msg"></li>
            </ol>
        </div>
        <div class="w-100 bg-white border rounded p-4">
            <h3 class="text-center mb-3">
                <img class="mr-1 d-inline align-middle" v-if="type === 'load'" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHdpZHRoPSIzMHB4IiBoZWlnaHQ9IjMwcHgiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48cGF0aCBkPSJNNzguNzUgMTYuMThWMS41NmE2NC4xIDY0LjEgMCAwIDEgNDcuNyA0Ny43SDExMS44YTQ5Ljk4IDQ5Ljk4IDAgMCAwLTMzLjA3LTMzLjA4ek0xNi40MyA0OS4yNUgxLjhhNjQuMSA2NC4xIDAgMCAxIDQ3LjctNDcuN1YxNi4yYTQ5Ljk4IDQ5Ljk4IDAgMCAwLTMzLjA3IDMzLjA3em0zMy4wNyA2Mi4zMnYxNC42MkE2NC4xIDY0LjEgMCAwIDEgMS44IDc4LjVoMTQuNjNhNDkuOTggNDkuOTggMCAwIDAgMzMuMDcgMzMuMDd6bTYyLjMyLTMzLjA3aDE0LjYyYTY0LjEgNjQuMSAwIDAgMS00Ny43IDQ3Ljd2LTE0LjYzYTQ5Ljk4IDQ5Ljk4IDAgMCAwIDMzLjA4LTMzLjA3eiIgZmlsbD0iIzAwMDAwMCIgZmlsbC1vcGFjaXR5PSIxIi8+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJyb3RhdGUiIGZyb209Ii05MCA2NCA2NCIgdG89IjAgNjQgNjQiIGR1cj0iNDAwbXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGVUcmFuc2Zvcm0+PC9nPjwvc3ZnPg==">
                <img class="mr-1 d-inline align-middle" v-if="type !== 'load'" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAIISURBVEhL7dZLiE5hHMfxE3JbDBZuWWmKct2o2WChKIUkC7OShZXFmJ1cM7NQFKVpSpKFKIpCEWXPZGFnYSZMlN1koRl33+/jOXXmMceM9z2nsZhffZr3+Z/znmeeyznnzabyv2c+FkR+rj1z8RY/E9/xDBtRS1Yh7+wqLuEa+mPtIxai8qxF3vE8CzGz8AHWd1qoOmUduwRDsL7eQtUpdpxP9Q28gut8CrWk2HFqGBfhtFeesaZ6GlaiD9bPo+m4Q4sjKFtjcwjWX4RWEzmIH3iHRRZIWccteATrjy00mhl4j7yT0zArkNdeYyD+HYm1z9iEhrMLXughvsJR+8+4nu7m54kn6MUGNJX7sOMteBA/78ZE04p18Fk+4SyDo3SqHeE+5KMfL/vxBp6vb7iH5Rg3J+CXzoVWls2Bz2AfEH+7wFH4vS+4jm48jTWXailK4wjdLJ7sCH0yaTDWzmCsOLXOkudstxAzHXdhvctCWbbBk8r4IpiJNMfgcTdZmsVw5HtCqyS34AWctmKKM7HXQpKb8NjZ0PrHeHHvR+9FN1ia4/Dil0NrdO7AY0dCq4GcxOHfH/+IP3G8hzeH1uj0wI59SaSZjdvYGloVZwfs2OVI304d8NiF0Ko47l6fYHbgtK/BEhzAJ3g/t6GWeI+/hJ0Xef93otY4ze1wWq/Al8tqTGWykmW/ACbanB8OsEAwAAAAAElFTkSuQmCC">
                <span class="align-middle">Метаграммы</span>
            </h3>
            <div class="w-100">
                <div class="form-group">
                    <label for="word-1">Первое слово:</label>
                    <input type="text" class="form-control" id="word-1" name="word_1" maxlength="4" v-model="word1">
                </div>
                <div class="form-group">
                    <label for="word-1">Второе слово:</label>
                    <input type="text" class="form-control" id="word-2" name="word_2" maxlength="4" v-model="word2">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success w-100 mt-3" v-bind:class="{ disabled : type === 'load' }" v-bind:disabled="type === 'load'" v-on:click="getWay( word1, word2 )">
                Найти связь
        </button>
        <button class="btn btn-light w-100 mt-3" v-bind:class="{ disabled : type === 'load' }" v-bind:disabled="type === 'load'" v-on:click="generateData()">
            Сгенерировать таблицу слов и связей
        </button>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                word1 : '',
                word2 : '',
                type : '',
                messages : [],
                disabled_style : {
                    cursor : 'default'
                }
            }
        },
        methods : {
            getWay : function ( w1, w2 ) {
                let self = this;

                if ( self.type !== 'load' ) {
                    self.messages = [];
                    self.type = 'load';

                    axios.post('getway', {word_1 : w1, word_2 : w2})
                        .then(function (response) {
                            self.messages = response.data.message;
                            self.type = response.data.type;
                        });
                }


            },
            generateData : function () {
                let self = this;

                if ( self.type !== 'load' ) {
                    self.messages = [];
                    self.type = 'load';

                    axios.post('generate')
                        .then(function (response) {
                            self.messages = response.data.message;
                            self.type = response.data.type;
                        });
                }
            }
        }
    }
</script>
