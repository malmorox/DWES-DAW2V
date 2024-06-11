from django.shortcuts import render, redirect
from django.views import generic
from django.views.generic.edit import FormMixin
from .models import Meme, Comentario
from .forms import ComentarioForm

class ListadoMemesView(generic.ListView):
    model = Meme
    template_name = 'memes/listado_memes.html'
    context_object_name = 'memes'

class DetalleMemeView(generic.DetailView):
    model = Meme
    template_name = 'memes/detalle_meme.html'
    context_object_name = 'meme'
    #form_class = ComentarioForm
    
    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['comentario_form'] = ComentarioForm()
        
        meme = self.object
        context['comentarios'] = meme.comentario_set.all()
        return context

    def post(self, request, *args, **kwargs):
        meme = self.get_object()
        form = ComentarioForm(request.POST)
        if form.is_valid():
            comentario = form.save(commit=False)
            comentario.meme = meme
            comentario.save()
        return redirect('detalle_meme', pk=meme.pk)
