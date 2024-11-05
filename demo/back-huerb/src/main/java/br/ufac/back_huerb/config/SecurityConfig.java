package br.ufac.back_huerb.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
@EnableWebSecurity
public class SecurityConfig {

    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
            .csrf(csrf -> csrf.disable())
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/api/usuarios/cadastrar").permitAll()
                .requestMatchers("/api/equipamentos/cadastrar").permitAll()
                .requestMatchers("/api/equipamentos/listar").permitAll()
                .requestMatchers("/api/login").permitAll()
                .requestMatchers("/api/solicitacoes/criar").permitAll()
                .requestMatchers("/api/solicitacoes/listar").permitAll()
                .requestMatchers("/api/solicitacoes/aprovadas").permitAll()
                .requestMatchers("/api/solicitacoes/marcarDevolvido").permitAll()
                .requestMatchers("/api/solicitacoes/atualizar/{id}").permitAll()
                .requestMatchers("/api/**").authenticated()
            )
            .formLogin(form -> form.permitAll())
            .logout(logout -> logout.permitAll());

        return http.build();
    }

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }
}
