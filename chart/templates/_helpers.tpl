{{- define "simpleipam.name" -}}
{{- .Chart.Name | trunc 63 | trimSuffix "-" -}}
{{- end }}

{{- define "simpleipam.fullname" -}}
{{- printf "%s-%s" .Release.Name (include "simpleipam.name" .) | trunc 63 | trimSuffix "-" -}}
{{- end }}
