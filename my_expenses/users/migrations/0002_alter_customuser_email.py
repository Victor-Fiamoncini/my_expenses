# Generated by Django 5.1 on 2024-08-30 02:50

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('users', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='customuser',
            name='email',
            field=models.EmailField(error_messages={'unique': 'A user with this email already exists.'}, max_length=254, unique=True),
        ),
    ]
