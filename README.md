## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# 🛡️ Upload Seguro de Imagem com Hashing (PHP POO & AJAX)

![Made with PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![Frontend JavaScript](https://img.shields.io/badge/Frontend-JavaScript-F7DF1E?logo=javascript&logoColor=black)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?logo=tailwindcss&logoColor=white)
![License MIT](https://img.shields.io/badge/License-MIT-green)
![Status Stable](https://img.shields.io/badge/Status-Stable-success)
![Version 1.0.0](https://img.shields.io/badge/Version-1.0.0-blue)
![GitHub stars](https://img.shields.io/github/stars/NinoMiquelino/php-image-uploader?style=social)
![GitHub forks](https://img.shields.io/github/forks/NinoMiquelino/php-image-uploader?style=social)
![GitHub issues](https://img.shields.io/github/issues/NinoMiquelino/php-image-uploader)

Este projeto implementa um sistema de upload de imagens focado em segurança e otimização de armazenamento. Ele simula o processo de envio de uma foto de perfil, onde o arquivo é validado e renomeado usando um *hash* único de seu conteúdo.

---

## 🚀 Arquitetura e Destaques

* **PHP POO (Service Layer):** A classe `ImageUploader` isola a lógica de manipulação de arquivos, validação e segurança.
* **Hashing de Conteúdo (`hash_file`):** O nome final do arquivo é gerado a partir de um hash SHA-256 do seu conteúdo.
    * **Segurança:** Garante que o nome do arquivo seja único e não exponha informações.
    * **Otimização:** Permite a detecção de uploads duplicados. Se um usuário fizer upload da mesma imagem duas vezes, o servidor retorna o caminho existente, economizando espaço em disco.
* **Validação Robusta:** O backend verifica tipo MIME (`image/jpeg`, `image/png`, etc.), tamanho máximo (2MB) e erros de upload do PHP.
* **AJAX com `FormData`:** O JavaScript lida com o envio assíncrono do arquivo usando o objeto nativo `FormData`, que permite o envio de dados binários sem a necessidade de bibliotecas externas.

---

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 7.4+ (POO, `$_FILES`, `hash_file`, manipulação de diretórios).
* **Frontend:** HTML5, JavaScript Vanilla (`fetch` API, `FormData`), Tailwind CSS.

---

## 🧩 Estrutura do Projeto

```
php-image-uploader/
├── index.html
├── README.md
├── .gitignore
└── 📁 src/
         ├── ImageUploader.php
         └── upload_api.php
└── 📁 /uploads
         └── 📁 /images
```
---

## ⚙️ Configuração e Instalação

### Pré-requisitos

1.  Um ambiente de servidor web com PHP.
2.  Permissão de escrita no diretório de uploads.

### Execução

1.  Crie a estrutura de pastas conforme o mapa.
2.  Crie o diretório de destino dos arquivos na raiz do projeto:
    ```bash
    mkdir -p uploads/images
    ```
3.  **Defina permissão de escrita** para o servidor web no diretório de uploads (necessário em ambientes Linux/macOS):
    ```bash
    chmod -R 777 uploads/
    ```
4.  Execute o servidor embutido do PHP (a partir da raiz do projeto):
    ```bash
    php -S localhost:8001
    ```
5.  Acesse o formulário: `http://localhost:8001/public/index.html`.

## 📝 Instruções de Uso

1.  Acesse a página `index.html`.
2.  Selecione uma imagem (JPEG, PNG ou GIF). O botão **Fazer Upload** será habilitado.
3.  Clique em **Fazer Upload**.
4.  O backend irá:
    * Validar o arquivo.
    * Calcular o hash SHA-256 do arquivo.
    * Salvar o arquivo no diretório `uploads/images/` com o nome do hash.
5.  O frontend exibirá uma mensagem de sucesso, atualizará a prévia com a imagem real do servidor e mostrará o *path* final.
6.  **Teste a Duplicação:** Faça upload da mesma imagem novamente. O sistema deve retornar sucesso instantaneamente, mas não salvar o arquivo novamente, comprovando a eficácia do hashing.

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/php-image-uploader/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/php-image-uploader/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
