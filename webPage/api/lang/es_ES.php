<?php

interface ERRORS
{
    const _NO_INFO_ = "No se ha proporcionado la información necesaria";
    const _INFO_NOT_FOUND_ = "Información no encontrada";
    const _INVALID_INFO_ = "Información inválida";
    const _METHOD_NOT_SUPPORTED_ = "Metodo no soportado";
    const _DUPLICATED_INFO_ = "Información duplicada";
    const _GENERIC_ = "Hubo un error";
    const _INVALID_EMAIL_ = "Correo inválido";
    const _WRONG_PASSWORD_ = "Contraseña incorrecta";
    const _SHORT_PASSWORD_ = "La contraseña debe tener al menos 8 caracteres";
    const _EXTRA_INFO_ = "Información extra";
}

interface RESPONSES
{
    const _SUCCESS_ = "Éxito";
    const _ERROR_ = "Error: ";

}