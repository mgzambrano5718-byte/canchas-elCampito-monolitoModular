# Diagrama E-R del Sistema ReservaTuCancha para El Campito
::: mermaid
erDiagram
    usuarios{
        id_usuario INT PK
        identificacion INT UK
        nombres VARCHAR(50)
        apellidos VARCHAR(80)
        correo VARCHAR(50)
        telefono INT
    }
    canchas{
        id_cancha INT PK
        nombre VARCHAR(50)
        capacidad INT
    }
    horarios{
        id_horario INT PK
        inicio TIME
        fin TIME
    }
    reservas{
        id_reserva INT PK
        id_usuario INT FK
        id_cancha INT FK
        id_horario INT FK
        fecha DATE 
    }
    usuarios ||--o{ reservas : registra
    canchas ||--o{ reservas: contiene
    horarios ||--o{ reservas: tiene
%% Estilos de los elementos %%
style usuarios fill: #ffe346, stroke: #db009d, stroke-width: 4px, color: #000000
:::