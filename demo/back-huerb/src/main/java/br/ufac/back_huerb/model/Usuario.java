package br.ufac.back_huerb.model;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class Usuario {

    @Id
    private String email;  // Defina o campo como chave primária

    private String password;
    private String userType;

    public Usuario() {
    }

    public Usuario(String email, String password, String userType) {
        this.email = email;
        this.password = password;
        this.userType = userType;
    }

    // Getters e Setters
    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getUserType() {
        return userType;
    }

    public void setUserType(String userType) {
        this.userType = userType;
    }
}
