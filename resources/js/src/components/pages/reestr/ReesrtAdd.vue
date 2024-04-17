<template>
    <div class="wrapper">
        <Sitebar/>
        <div class="content">
            <Header />
            <div class="containers">
                <div class="main">
                    <div class="main__header">
                        <div class="main__header-top">
                            <h1 class="main__header-top-title">
                                Добавить запись в реестр🐻
                            </h1>
                        </div>
                    </div>
                    <div class="main__content">
                        <div class="reestr">
                            <form class="reestr__form">
                                <div class="reestr__grid">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Подразделение ОСП</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Подразделение ОСП">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Регистрационный номер ИП</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Регистрационный номер ИП">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Дата возбуждения</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Дата возбуждения">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Взыскатель</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Взыскатель">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Должник</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Должник">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Статус</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Статус">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Номер дела</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Номер дела">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Сумма долга</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Сумма долга">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Номер ИД</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Номер ИД">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">ИНН</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="ИНН">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">СПИ, ведущий ИП</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="СПИ, ведущий ИП">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">СНИЛС</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="СНИЛС">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Орган, выдавший ИД</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Орган, выдавший ИД">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Адрес должника</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Адрес должника">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Столбец1</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Столбец1">
                                    </div>
                                </div>
                                <div class="form__button" style="margin-top: 16px">
                                    <button class="button button-primary">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "@/components/layouts/Header.vue";
import Sitebar from "@/components/layouts/Sitebar.vue";

export default {
    name: "ReesrtAdd",
    components: {Sitebar, Header}
}
</script>

<style scoped>

</style>
