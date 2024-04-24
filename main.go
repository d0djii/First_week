package main

import (
	"html/template"
	"net/http"
	"os"
	"path/filepath"

	"github.com/gin-gonic/gin"
)

func main() {
	// Получаем путь к папке assets
	assetsDir := "assets"
	if wd, err := os.Getwd(); err == nil {
		assetsDir = filepath.Join(wd, "assets")
	}

	// Создаем новый экземпляр Gin
	r := gin.Default()

	// Обработчики для различных страниц
	r.GET("/", indexRedirectHandler) // Перенаправление с / на /index.html
	r.GET("/index.html", indexHandler)
	r.GET("/register/login.html", loginHandler)
	r.GET("/register/register.html", registerHandler)
	r.GET("/profile.html", profileHandler)
	r.GET("/cart.html", cartHandler)

	// Обработчик для статических файлов (стилей)
	r.Static("/assets", assetsDir)

	// Настройка сервера
	r.Run(":8080")
}

func indexRedirectHandler(c *gin.Context) {
	c.Redirect(http.StatusSeeOther, "/index.html")
}

func indexHandler(c *gin.Context) {
	renderTemplate(c, "templates/index.html", nil)
}

func loginHandler(c *gin.Context) {
	renderTemplate(c, "templates/login.html", nil)
}

func registerHandler(c *gin.Context) {
	renderTemplate(c, "templates/register.html", nil)
}

func profileHandler(c *gin.Context) {
	renderTemplate(c, "templates/profile.html", nil)
}

func cartHandler(c *gin.Context) {
	renderTemplate(c, "templates/cart.html", nil)
}

func renderTemplate(c *gin.Context, tmpl string, data interface{}) {
	// Ваш код для рендеринга HTML-шаблона
	t, err := template.ParseFiles(tmpl)
	if err != nil {
		c.String(http.StatusInternalServerError, err.Error())
		return
	}
	err = t.Execute(c.Writer, data)
	if err != nil {
		c.String(http.StatusInternalServerError, err.Error())
	}
}
