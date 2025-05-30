<link rel="stylesheet" href="./assets/css/crear-usuario.css">
 
        
<div class="container">
        <h1>Crear usuario</h1>

       <form action="procesar-usuario.php" method="POST">
            <div class="form-group">
                <label>Nombres usuario</label>
                <div class="form-column">
                    <input type="text" name="primer_nombre" placeholder="Primer nombre" required>
                    <input type="text" name="segundo_nombre" placeholder="Segundo nombre">
                </div>
            </div>

            <div class="form-group">
                <label>Apellidos usuario</label>
                <div class="form-column">
                    <input type="text" name="primer_apellido" placeholder="Primer apellido" required>
                    <input type="text" name="segundo_apellido" placeholder="Segundo apellido">
                </div>
            </div>

            <div class="form-group">
                <label>Correo institucional</label>
                <input type="email" name="correo" placeholder="Correo" required>
            </div>

            <div class="form-group">
                <label>Documento del usuario</label>
                <div style="margin-bottom: 10px;">
                    <label style="font-size: 12px; color: #666;">Tipo de documento</label>
                </div>
                <div class="document-row">
                    <select name="tipo_documento" class="document-type" required>
                        <option value="cedula_ciudadania">Cédula de ciudadanía</option>
                        <option value="cedula_extranjeria">Cédula de extranjería</option>
                        <option value="pasaporte">Pasaporte</option>
                    </select>
                   
                </div>
                <div style="margin-top: 10px;">
                    <input type="texto" name="numero_documento" placeholder="Número de documento" class="document-number" required>
                </div>
            </div>

            <div class="form-group">
                <label>Rol</label>
                <div class="role-row">
                    <select name="rol" class="role-select" required>
                        <option value="usuario">Usuario</option>
                        <option value="admin">Admin</option>
                    </select>
                    
                </div>
            </div>

            <div class="form-group">
                <label>Tipo instructor <span class="optional">(opcional)</span></label>
                <div class="instructor-row">
                    <select name="tipo_instructor" class="instructor-select">
                        <option value="">Seleccionar</option>
                        <option value="tecnico">Técnico</option>
                        <option value="transversal">Transversal</option>
                    </select>
                
                </div>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <label>Contrato <span class="optional">(opcional)</span></label>
                <div class="contract-row">
                    <input type="ref" name="fecha_inicio_contrato" placeholder="Fecha inicio contrato">
                    <input type="ref" name="fecha_fin_contrato" placeholder="Fecha fin contrato">
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancelar</button>
                <button type="submit" class="btn btn-create">Crear aprendiz</button>
            </div>
        </form>
        </div>
   